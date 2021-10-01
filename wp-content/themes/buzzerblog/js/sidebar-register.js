"use strict";

var _awpCustomPostmetaFields = _interopRequireDefault(require("./awp-custom-postmeta-fields"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

const {
  registerPlugin
} = wp.plugins;
registerPlugin('my-custom-postmeta-plugin', {
  render() {
    return /*#__PURE__*/React.createElement(_awpCustomPostmetaFields.default, null);
  }

});