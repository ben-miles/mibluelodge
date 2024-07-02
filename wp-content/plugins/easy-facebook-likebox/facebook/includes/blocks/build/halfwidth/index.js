/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/components/ConnectAccount.js":
/*!******************************************!*\
  !*** ./src/components/ConnectAccount.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ ConnectAccount)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);



function ConnectAccount({
  adminUrl
}) {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("fieldset", {
    className: "components-placeholder__fieldset"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "esf-fb-no-pages"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "block-editor-block-card__description"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('No account found, please connect the Facebook account using the following button', 'easy-facebook-likebox')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Button, {
    isPrimary: true,
    target: "_blank",
    href: `${adminUrl}admin.php?page=easy-facebook-likebox`
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Connect', 'easy-facebook-likebox')))));
}

/***/ }),

/***/ "./src/halfwidth/edit.js":
/*!*******************************!*\
  !*** ./src/halfwidth/edit.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Edit)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/server-side-render */ "@wordpress/server-side-render");
/* harmony import */ var _wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./editor.scss */ "./src/halfwidth/editor.scss");
/* harmony import */ var _components_ConnectAccount__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../components/ConnectAccount */ "./src/components/ConnectAccount.js");

/**
 * WordPress dependencies
 */






/**
 * Internal dependencies
 */



/**
 * The Edit component for your block.
 *
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @param {Object} props The props object.
 * @param {Object} props.attributes The attributes object.
 * @param {function} props.setAttributes A function to update attributes.
 *
 * @return {WPElement} Element to render.
 */
function Edit({
  attributes,
  setAttributes
}) {
  // Destructure the fan page id from attributes
  const {
    fanpage_id: fanPageId,
    filter,
    album_id: albumId,
    type
  } = attributes;

  // Fetch adminUrl from the global esfFBBlockData
  const adminUrl = esfFBBlockData.adminUrl;

  // Use a state hook to hold the selected page value
  const [selectedPage, setSelectedPage] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(fanPageId);
  const [selectedAlbum, setSelectedAlbum] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(albumId);
  const [isAlbumChanged, setIsAlbumChanged] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(false);

  // Hold the album options
  const [albumOptions, setAlbumOptions] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)([]);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    // Function to fetch the albums of the selected fan page
    const fetchAlbums = async () => {
      if (selectedPage && type !== 'group') {
        try {
          const response = await fetch(esfFBBlockData.ajax_url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
              action: 'efbl_get_albums_list',
              page_id: selectedPage,
              efbl_nonce: esfFBBlockData.nonce,
              is_block: true
            })
          });
          const {
            success,
            data
          } = await response.json();
          if (success && Array.isArray(data)) {
            setAlbumOptions(data.map(album => ({
              label: album.name,
              value: album.id
            })));
          } else {
            console.error('Error retrieving album list');
          }
        } catch (error) {
          console.error(error);
        }
      } else {
        setAlbumOptions([]);
      }
    };
    fetchAlbums();
  }, [selectedPage]);
  const handleAlbumChange = newValue => {
    setSelectedAlbum(newValue);
    setIsAlbumChanged(true);
    if (newValue === 'none') {
      setAttributes({
        album_id: ''
      });
    } else {
      setAttributes({
        album_id: newValue
      });
    }
  };

  /**
   * An event handler for radio button selection changes
   *
   * @param {string} newValue The new selected value.
   */
  const handleRadioChange = newValue => {
    setSelectedPage(newValue);
  };

  /**
   * An event handler for the Display button click.
   *
   * Updates the fanpage_id attribute with the currently selected page.
   */
  const handleDisplayButtonClick = () => {
    setAttributes({
      fanpage_id: selectedPage,
      album_id: selectedAlbum
    });
    setIsAlbumChanged(false);
  };

  // Additional handler for disconnect button
  const handleDisconnectButtonClick = () => {
    setSelectedPage(null);
    setAttributes({
      fanpage_id: null,
      filter: '',
      album_id: '',
      type: ''
    });
  };

  // Compute radio options if esfFBBlockData.pages exists and is an object
  const radioOptions = esfFBBlockData && esfFBBlockData.pages && typeof esfFBBlockData.pages === 'object' ? Object.entries(esfFBBlockData.pages).map(([id, pageData]) => ({
    label: pageData.name,
    value: id
  })) : [];

  // Compute radio options if esfFBBlockData.groups exists and is an object
  const groupsOptions = esfFBBlockData && esfFBBlockData.groups && typeof esfFBBlockData.groups === 'object' ? Object.entries(esfFBBlockData.groups).map(([id, pageData]) => ({
    label: pageData.name,
    value: id
  })) : [];

  // If fan page id is already selected, simply render the block from php
  if (fanPageId) {
    let selectedAccountName;
    if (type === 'page' || type === '') {
      selectedAccountName = esfFBBlockData.pages[fanPageId].name;
    } else {
      selectedAccountName = esfFBBlockData.groups[fanPageId].id;
    }
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)(), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Account Settings', 'easy-facebook-likebox'),
      initialOpen: true
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Account', 'easy-facebook-likebox')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, selectedAccountName)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Button, {
      isSecondary: true,
      onClick: handleDisconnectButtonClick
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Reset', 'easy-facebook-likebox')))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
      title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Display Settings', 'easy-facebook-likebox'),
      initialOpen: true
    }, type === 'page' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Filter", "easy-facebook-likebox"),
      value: filter,
      options: [{
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("None", "easy-facebook-likebox"),
        value: ""
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Images", "easy-facebook-likebox"),
        value: "images"
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Videos", "easy-facebook-likebox"),
        value: "videos"
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Events", "easy-facebook-likebox"),
        value: "events"
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Albums", "easy-facebook-likebox"),
        value: "albums"
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Mentioned", "easy-facebook-likebox"),
        value: "mentioned"
      }],
      onChange: value => {
        setAttributes({
          filter: value
        });
      }
    }), filter === 'events' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Notice, {
      status: "info",
      isDismissible: false
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Due to recent changes by Facebook in the API. You need to create your own application in order to display events on your site.", "easy-facebook-likebox")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: "https://easysocialfeed.com/custom-facebook-feed/page-token/",
      target: "_blank",
      rel: "noopener noreferrer"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Please follow the steps in this guide", "easy-facebook-likebox"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)(" to create the application. Note: It is required only to display events.", "easy-facebook-likebox"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Events Filter", "easy-facebook-likebox"),
      value: attributes.events_filter,
      options: [{
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Upcoming", "easy-facebook-likebox"),
        value: "upcoming"
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Past", "easy-facebook-likebox"),
        value: "past"
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("All", "easy-facebook-likebox"),
        value: "all"
      }],
      onChange: value => {
        setAttributes({
          events_filter: value
        });
      }
    })), filter === 'albums' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Album", "easy-facebook-likebox"),
      value: selectedAlbum,
      options: [{
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("None", "easy-facebook-likebox"),
        value: "none"
      }, ...albumOptions],
      onChange: handleAlbumChange
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Words Limit', 'easy-facebook-likebox'),
      type: "number",
      min: "1",
      value: attributes.words_limit || '',
      onChange: value => setAttributes({
        words_limit: parseInt(value, 10)
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Open links in new tab', 'easy-facebook-likebox'),
      checked: attributes.links_new_tab,
      onChange: value => setAttributes({
        links_new_tab: value ? 1 : 0
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Post Limit', 'easy-facebook-likebox'),
      type: "number",
      min: "1",
      value: attributes.post_limit || '',
      onChange: value => setAttributes({
        post_limit: parseInt(value, 10)
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Cache Unit', 'easy-facebook-likebox'),
      type: "number",
      min: "1",
      value: attributes.cache_unit || '',
      onChange: value => setAttributes({
        cache_unit: parseInt(value, 10)
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.SelectControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Cache Duration', 'easy-facebook-likebox'),
      value: attributes.cache_duration,
      options: [{
        value: 'minutes',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Minutes', 'easy-facebook-likebox')
      }, {
        value: 'hours',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Hours', 'easy-facebook-likebox')
      }, {
        value: 'days',
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Days', 'easy-facebook-likebox')
      }],
      onChange: value => setAttributes({
        cache_duration: value
      })
    }), type === 'page' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToggleControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Show Likebox', 'easy-facebook-likebox'),
      checked: attributes.show_like_box,
      onChange: value => setAttributes({
        show_like_box: value ? 1 : 0
      })
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("h2", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Upgrade to unlock following blocks", "easy-facebook-likebox"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("ol", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Carousel", "easy-facebook-likebox")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Masonry", "easy-facebook-likebox")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Grid", "easy-facebook-likebox")))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: "/wp-admin/admin.php?page=feed-them-all-pricing",
      className: "button button-primary",
      target: "_blank",
      rel: "noopener noreferrer"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Upgrade Now", "easy-facebook-likebox"))))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)((_wordpress_server_side_render__WEBPACK_IMPORTED_MODULE_3___default()), {
      block: "esf-fb/halfwidth",
      attributes: attributes,
      EmptyResponsePlaceholder: () => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Spinner, null)
    }));
  }
  // Render the block editor interface for selecting a page and displaying the block
  else {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)(), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "components-placeholder is-large"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "components-placeholder__label esf-fb-block-header"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
      className: "dashicon dashicons dashicons-facebook"
    }), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('ESF Facebook Halfwidth', 'easy-facebook-likebox')), esfFBBlockData && (esfFBBlockData.pages || esfFBBlockData.groups) ? (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("fieldset", {
      className: "components-placeholder__fieldset"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "esf-fb-select-pages"
    }, type === '' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.RadioControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Select Type', 'easy-facebook-likebox'),
      selected: type,
      options: [{
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Page', 'easy-facebook-likebox'),
        value: 'page'
      }, {
        label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Group', 'easy-facebook-likebox'),
        value: 'group'
      }],
      onChange: value => {
        setAttributes({
          type: value
        });
      }
    }), esfFBBlockData.pages && type === 'page' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.RadioControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Select Page', 'easy-facebook-likebox'),
      selected: selectedPage,
      options: radioOptions,
      onChange: handleRadioChange
    }), esfFBBlockData.groups && type === 'group' && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.RadioControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Select Group', 'easy-facebook-likebox'),
      selected: selectedPage,
      options: groupsOptions,
      onChange: handleRadioChange
    }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Button, {
      isPrimary: true,
      onClick: handleDisplayButtonClick
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Display', 'easy-facebook-likebox')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Button, {
      isSecondary: true,
      onClick: handleDisconnectButtonClick
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Reset', 'easy-facebook-likebox'))))) : (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_components_ConnectAccount__WEBPACK_IMPORTED_MODULE_6__["default"], {
      adminUrl: adminUrl
    })));
  }
}

/***/ }),

/***/ "./src/halfwidth/index.js":
/*!********************************!*\
  !*** ./src/halfwidth/index.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/halfwidth/style.scss");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/halfwidth/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./save */ "./src/halfwidth/save.js");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./block.json */ "./src/halfwidth/block.json");
/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */


/**
 * Internal dependencies
 */




/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_4__.name, {
  /**
   * @see ./edit.js
   */
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  /**
   * @see ./save.js
   */
  save: _save__WEBPACK_IMPORTED_MODULE_3__["default"]
});

/***/ }),

/***/ "./src/halfwidth/save.js":
/*!*******************************!*\
  !*** ./src/halfwidth/save.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ save)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */


/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
function save() {
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save(), 'ESF Block – Content is being loaded from server side');
}

/***/ }),

/***/ "./src/halfwidth/editor.scss":
/*!***********************************!*\
  !*** ./src/halfwidth/editor.scss ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/halfwidth/style.scss":
/*!**********************************!*\
  !*** ./src/halfwidth/style.scss ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "@wordpress/server-side-render":
/*!******************************************!*\
  !*** external ["wp","serverSideRender"] ***!
  \******************************************/
/***/ ((module) => {

module.exports = window["wp"]["serverSideRender"];

/***/ }),

/***/ "./src/halfwidth/block.json":
/*!**********************************!*\
  !*** ./src/halfwidth/block.json ***!
  \**********************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"esf-fb/halfwidth","version":"0.1.0","title":"Easy Social Feed Facebook Halfwidth","category":"widgets","icon":"smiley","description":"Display your Facebook feed in a Halfwidth.","supports":{"html":false},"textdomain":"easy-social-feed-facebook-halfwidth","editorScript":"file:./index.js","editorStyle":"file:./index.css","style":"file:./style-index.css"}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"halfwidth/index": 0,
/******/ 			"halfwidth/style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = globalThis["webpackChunkeasy_social_feed_facebook_carousel"] = globalThis["webpackChunkeasy_social_feed_facebook_carousel"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["halfwidth/style-index"], () => (__webpack_require__("./src/halfwidth/index.js")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map