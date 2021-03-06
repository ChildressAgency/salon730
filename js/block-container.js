registerBlockType( 'childress/container', {
    title: 'Container',
    icon: 'editor-contract',
    category: 'layout',

    attributes: {
        classes: {
            type: 'string',
            default: 'container'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { classes } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                    <SelectControl
                        label="Container Width"
                        value={ classes ? classes : '' }
                        options={[
                            {
                                label: 'Full-Width',
                                value: 'container'
                            },
                            {
                                label: 'Thin',
                                value: 'container container--thin'
                            }
                        ]}
                        onChange={ ( value ) => setAttributes({ classes: value }) }
                    />
                </InspectorControls>
                <div className={ attributes.classes }>
                    <InnerBlocks />
                </div>
            </Fragment>
        );
    },

    save( { attributes } ) {
        return (
            <div className={ attributes.classes }>
                <InnerBlocks.Content />
            </div>
        );
    },
} );