registerBlockType( 'childress/price-list', {
    title: 'Price List',
    icon: 'media-spreadsheet',
    category: 'custom-blocks',

    edit( { attributes, className, setAttributes } ) {
        return (
            <div className={ className + ' price-list' }>
                <InnerBlocks
                    allowedBlocks={['childress/price-item']}
                    template={[
                        ['childress/price-item'],
                        ['childress/price-item'],
                        ['childress/price-item']
                    ]}
                />
            </div>
        );
    },

    save( { attributes } ) {
        return (
            <div className="price-list">
                <div className="container">
                    <InnerBlocks.Content />
                </div>
            </div>
        );
    },
} );

registerBlockType( 'childress/price-item', {
    title: 'Price Item',
    icon: 'media-spreadsheet',
    category: 'custom-blocks',
    parent: ['childress/price-list'],

    attributes: {
        label: {
            type: 'string'
        },
        price: {
            type: 'string'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { label, price } = attributes;

        return (
            <div className={ className + ' price-list__item' }>
                <p>
                    <PlainText
                        value={ label }
                        onChange={ ( value ) => { setAttributes({ label: value }) } }
                        placeholder="Label"
                    />
                    <span></span>
                    $<PlainText
                        value={ price }
                        onChange={ ( value ) => { setAttributes({ price: value }) } }
                        placeholder="Price"
                    />
                </p>
            </div>
        );
    },

    save( { attributes } ) {
        const { label, price } = attributes;

        return (
            <div className="price-list__item">
                <p>{ label }<span></span>${ price }</p>
            </div>
        );
    },
} );
