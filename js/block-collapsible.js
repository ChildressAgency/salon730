registerBlockType( 'childress/collapsible', {
    title: 'Collapsible Block',
    icon: 'arrow-down',
    category: 'custom-blocks',

    attributes: {
        title: {
            type: 'string',
            source: 'text',
            selector: '.collapsible__title'
        },
        subtitle: {
            type: 'string',
            source: 'text',
            selector: '.collapsible__subtitle'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { title, subtitle } = attributes;

        return (
            <div className={ className + ' collapsible' }>
                <h4 className="collapsible__title">
                    <PlainText
                        value={ title }
                        onChange={ ( value ) => { setAttributes({ title: value }) } }
                        placeholder="Title"
                    />
                </h4>
                <p className="collapsible__subtitle">
                    <PlainText
                        value={ subtitle }
                        onChange={ ( value ) => { setAttributes({ subtitle: value }) } }
                        placeholder="Subtitle"
                    />
                </p>
                <InnerBlocks
                    template={[
                        ['childress/price-list']
                    ]}
                />
            </div>
        );
    },

    save( { attributes } ) {
        const { title, subtitle } = attributes;

        return (
            <div className="collapsible">
                <div className="container">
                    <h4 className="collapsible__title"><span class="collapsible__arrow"><i class="fas fa-caret-right"></i></span>{ title }</h4>
                    <div class="collapsible__content">
                        <p className="collapsible__subtitle">{ subtitle }</p>
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
        );
    },
} );

