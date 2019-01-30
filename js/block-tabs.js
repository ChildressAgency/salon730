registerBlockType( 'childress/tabs', {
    title: 'Tabs',
    icon: 'tickets-alt',
    category: 'custom-blocks',

    attributes: {
        tab1Title: {
            type: 'string'
        },
        tab2Title: {
            type: 'string'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { tab1Title, tab2Title } = attributes;

        return (
            <div className={ className }>
                <div className="tabs__titles">
                    <h2>
                        <PlainText
                            value={ tab1Title }
                            onChange={ ( value ) => { setAttributes({ tab1Title: value }) } }
                            placeholder="Tab 1 Title"
                        />
                    </h2>
                    <h2>
                        <PlainText
                            value={ tab2Title }
                            onChange={ ( value ) => { setAttributes({ tab2Title: value }) } }
                            placeholder="Tab 2 Title"
                        />
                    </h2>
                </div>
                <div className="tabs__content">
                    <InnerBlocks
                        allowedBlocks={['childress/tab']}
                        template={[
                            ['childress/tab'],
                            ['childress/tab']
                        ]}
                        templateLock='all'
                    />
                </div>
            </div>
        );
    },

    save( { attributes } ) {
        const { tab1Title, tab2Title } = attributes;

        return (
            <div className="tabs">
                <div className="container">
                    <div className="tabs__titles">
                        <h2 className="tabs__title tabs__title--a tabs__title--active">{ tab1Title }</h2>
                        <h2 className="tabs__title tabs__title--b">{ tab2Title }</h2>
                    </div>
                    <div className="tabs__content">
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
        );
    },
} );

registerBlockType( 'childress/tab', {
    title: 'Tab',
    icon: 'tickets-alt',
    category: 'custom-blocks',
    parent: ['childress/tabs'],

    edit( { attributes, className, setAttributes } ) {
        return (
            <div className={ className + ' tab'}>
                <InnerBlocks 
                    template={[
                        ['core/paragraph', { placeholder: 'Tab' }]
                    ]}
                    templateLock='false'
                />
            </div>
        );
    },

    save( { attributes } ) {
        return (
            <div className="tab">
                <InnerBlocks.Content />
            </div>
        );
    },
} );

