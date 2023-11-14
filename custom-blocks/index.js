(function () {
    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var TextControl = wp.components.TextControl;

    registerBlockType('ict4today/custom-block', {
        title: 'Custom Block',
        icon: 'admin-comments',
        category: 'common',
        attributes: {
            content: {
                type: 'string',
                default: 'Hello, Gutenberg!'
            }
        },
        edit: function (props) {
            var content = props.attributes.content;
            return el(
                TextControl,
                {
                    value: content,
                    onChange: function (newContent) {
                        props.setAttributes({ content: newContent });
                    },
                }
            );
        },
        save: function (props) {
            return el('p', {}, props.attributes.content);
        },
    });
})();