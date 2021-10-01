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

"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
const {
  __
} = wp.i18n;
const {
  compose
} = wp.compose;
const {
  withSelect,
  withDispatch
} = wp.data;
const {
  PluginDocumentSettingPanel
} = wp.editPost;
const {
  ToggleControl,
  TextControl,
  PanelRow
} = wp.components;

const AWP_Custom_Plugin = ({
  postType,
  postMeta,
  setPostMeta
}) => {
  if ('post' !== postType) return null; // Will only render component for post type 'post'

  return /*#__PURE__*/React.createElement(PluginDocumentSettingPanel, {
    title: __('My Custom Post meta', 'txtdomain'),
    icon: "edit",
    initialOpen: "true"
  }, /*#__PURE__*/React.createElement(PanelRow, null, /*#__PURE__*/React.createElement(ToggleControl, {
    label: __('You can toggle me on or off', 'txtdomain'),
    onChange: value => setPostMeta({
      _my_custom_bool: value
    }),
    checked: postMeta._my_custom_bool
  })), /*#__PURE__*/React.createElement(PanelRow, null, /*#__PURE__*/React.createElement(TextControl, {
    label: __('Write some text, if you like', 'txtdomain'),
    value: postMeta._my_custom_text,
    onChange: value => setPostMeta({
      _my_custom_text: value
    })
  })));
};

var _default = compose([withSelect(select => {
  return {
    postMeta: select('core/editor').getEditedPostAttribute('meta'),
    postType: select('core/editor').getCurrentPostType()
  };
}), withDispatch(dispatch => {
  return {
    setPostMeta(newMeta) {
      dispatch('core/editor').editPost({
        meta: newMeta
      });
    }

  };
})])(AWP_Custom_Plugin);

exports.default = _default;