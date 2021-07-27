"use strict";

const {
  Component
} = React;
const {
  createPortal,
  render
} = ReactDOM;

class ContentEditor extends Component {
  constructor(props) {
    super(props);
    this._initEditor = this._initEditor.bind(this);
  }

  componentDidMount() {
    this.timer = setTimeout(this._initEditor, 300);
  }

  _initEditor() {
    new FroalaEditor(`#${this.props.editorId}`, editorConfig);
  }

  render() {
    const {
      name,
      defaultValue,
      editorId
    } = this.props; // console.log(this.props);

    return React.createElement("textarea", {
      name: name,
      className: "form-control editor",
      id: editorId,
      defaultValue: defaultValue
    });
  }

}

class AdminContent extends Component {
  constructor(props) {
    super(props);
    this.state = {
      list: [true],
      remove: [],
      loading: false
    };
    this._addContent = this._addContent.bind(this);
    this._onGetContents = this._onGetContents.bind(this);
    this._removeItemList = this._removeItemList.bind(this);
  }

  componentDidMount() {
    this.setState({
      loading: true
    });
    $.get(window.location.href, this._onGetContents);
  }

  _onGetContents(res) {
    let list;
    if (!res || !res.length || !(list = JSON.parse(res))) return this.setState({
      loading: false
    });
    return this.setState({
      list,
      loading: false
    });
  }

  _addContent() {
    return this.setState(({
      list
    }) => {
      list.push(true);
      return {
        list
      };
    });
  }

  _removeItemList(idx) {
    return this.setState(({
      remove
    }) => {
      remove.push(idx);
      return {
        remove
      };
    });
  }

  _remoteDelete(id) {
    return new Promise(resolve => {
      $.post(`/admin/content/removeContent/${id}`, {}, resolve);
    });
  }

  async _remove(item, idx) {
    if (typeof item === 'object') {
      const ans = confirm('Bạn có chắc sẽ xoá đi nội dung này?');
      if (!ans) return;

      try {
        await this._remoteDelete(item.id);
        return this._removeItemList(idx);
      } catch (e) {
        console.log(e);
      }
    }

    return this._removeItemList(idx);
  }

  render() {
    let target;
    const {
      loading
    } = this.state;
    return React.createElement(React.Fragment, null, !this.state.list.length ? React.createElement("div", {
      className: "empty-block"
    }, React.createElement("img", {
      src: "/images/no-content.jpg",
      alt: "No content"
    }), React.createElement("h4", null, loading ? 'Đang tải...' : 'Không có nội dung'), React.createElement("button", {
      type: "button",
      className: "btn btn-outline-info btn-round",
      role: "button",
      onClick: this._addContent
    }, "Th\xEAm")) : this.state.list.map((item, idx) => {
      if (this.state.remove.includes(idx)) return null;
      let key = typeof item === 'object' ? item.id : `_${idx}`;
      return React.createElement("div", {
        key: `h.${idx}`,
        className: "content-item"
      }, React.createElement("div", {
        className: "flex-title"
      }, React.createElement("input", {
        type: "text",
        name: `contents[${key}][title]`,
        className: "form-control flex-row",
        placeholder: "Nh\u1EADp ti\xEAu \u0111\u1EC1...",
        autoCapitalize: 'true',
        autoComplete: 'off',
        autoCorrect: 'false',
        defaultValue: item && item.title
      }), React.createElement("button", {
        className: "btn btn-just-icon btn-danger btn-remove",
        type: 'button',
        onClick: this._remove.bind(this, item, idx)
      }, React.createElement("i", {
        className: "material-icons",
        "data-notify": "icon"
      }, "delete"))), React.createElement(ContentEditor, {
        name: `contents[${key}][content]`,
        editorId: `editor${key}`,
        defaultValue: item && item.content
      }));
    }), !this.state.list.length || !(target = document.getElementById('add-holder')) ? null : createPortal(React.createElement("button", {
      type: 'button',
      className: 'btn btn-outline-info btn-round',
      onClick: this._addContent
    }, "Th\xEAm n\u1ED9i dung"), target));
  }

}

let wrap;

if (wrap = document.getElementById('content-list')) {
  render(React.createElement(AdminContent, null), wrap);
}
//# sourceMappingURL=admin_content.js.map