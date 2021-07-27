"use strict";

const {
  Component
} = React;
const {
  createPortal,
  render
} = ReactDOM;

class ShoppingCart extends Component {
  constructor(props) {
    super(props);
    this.state = {
      cart: {}
    };
    this._requestList = this._requestList.bind(this);
    this._add = this._add.bind(this);
    this._decrement = this._decrement.bind(this);
    this._remove = this._remove.bind(this);
    this._refresh = this._refresh.bind(this);
  }

  componentDidMount() {
    this._requestList();
  }

  _requestList() {
    $.get('/cart', data => this.setState({
      cart: JSON.parse(data) || {}
    }, () => {
      const {
        cart
      } = this.state;
      if (!cart) return;
      const badge = $('#cart-badge');
      $('span', badge).text(cart.total);
    }));
  }

  _refresh(res) {
    if (!res) return;

    this._requestList();

    $.toast({
      heading: 'Giỏ hàng',
      text: 'Cập nhật thành công',
      icon: 'success',
      bgColor: 'green',
      position: 'bottom-right'
    });
  }

  _add(e, id) {
    e.preventDefault();
    $.post('/shopping-cart/add', {
      id: id
    }, this._refresh);
    return false;
  }

  _decrement(e, id) {
    e.preventDefault();
    $.post('/shopping-cart/decrement', {
      id: id
    }, this._refresh);
    return false;
  }

  _remove(e, id) {
    e.preventDefault();

    if (confirm('Xác nhận xoá đi sản phẩm này trong giỏ hàng?')) {
      $.post(e.currentTarget.getAttribute('href'), {
        id
      }, this._refresh);
    }

    return false;
  }

  render() {
    const {
      cart
    } = this.state;

    if (!cart || !cart.hasOwnProperty('items') || !Object.keys(cart.items).length) {
      return React.createElement("div", {
        className: "empty-block"
      }, React.createElement("img", {
        src: "/images/no-content.jpg",
        alt: "No content"
      }), React.createElement("h4", null, "Gi\u1ECF h\xE0ng \u0111ang tr\u1ED1ng "));
    }

    let item;
    return React.createElement("div", null, React.createElement("table", {
      className: 'table cart-table table-striped'
    }, React.createElement("thead", null, React.createElement("tr", null, React.createElement("th", null), React.createElement("th", null, "S\u1EA3n ph\u1EA9m"), React.createElement("th", null, "S\u1ED1 l\u01B0\u1EE3ng"), React.createElement("th", null, "\u0110\u01A1n gi\xE1"))), React.createElement("tbody", null, Object.keys(cart.items).map(idx => !(item = cart.items[idx]) ? null : React.createElement("tr", {
      key: `Item${idx}`
    }, React.createElement("td", null, React.createElement("img", {
      src: item.data.image,
      alt: item.data.title,
      style: {
        width: 40
      }
    })), React.createElement("td", null, item.data.title), React.createElement("td", null, React.createElement("div", {
      className: 'input-number'
    }, React.createElement("span", {
      className: 'cart-qty'
    }, item.quantity), React.createElement("span", {
      className: 'qty-up',
      onClick: e => this._add(e, idx)
    }, "+"), React.createElement("span", {
      className: 'qty-down',
      onClick: e => this._decrement(e, idx)
    }, "-"))), React.createElement("td", null, item.sum ? new Intl.NumberFormat('vi-VN').format(item.sum) : 0, " \u0111"), React.createElement("td", null, React.createElement("a", {
      className: 'cart-remove',
      href: '/shopping-cart/remove',
      onClick: e => this._remove(e, idx)
    }, React.createElement("i", {
      className: 'fa fa-trash'
    })))))), React.createElement("tbody", null, React.createElement("tr", null, React.createElement("td", {
      colSpan: 3,
      className: 'text-right'
    }, React.createElement("b", null, "T\u1ED4NG TI\u1EC0N: ")), React.createElement("td", null, cart.sum ? new Intl.NumberFormat('vi-VN').format(cart.sum) : 0, " \u0111"), React.createElement("td", null)))), React.createElement("div", {
      className: "row"
    }, React.createElement("div", {
      className: "col-md-12 text-center"
    }, React.createElement("p", null, React.createElement("a", {
      href: "/checkout",
      className: "btn btn-danger btn-custom-red order-submit"
    }, "T\xEDnh ti\u1EC1n")))));
  }

}

let wrap;

if (wrap = document.getElementById('cart-content')) {
  render(React.createElement(ShoppingCart, null), wrap);
}
//# sourceMappingURL=shopping_cart.js.map