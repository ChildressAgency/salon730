registerBlockType( 'childress/stylists', {
    title: 'Stylists',
    icon: 'groups',
    category: 'custom-blocks',

    attributes: {
        category: {
            type: 'string',
            default: 'elite-1'
        },
    },

    edit( { attributes, className, setAttributes } ){
        const { category } = attributes;

        return (
            <SelectControl
                label="Category"
                value={ category ? category : 'elite-1' }
                options={[
                    {
                        label: 'Elite 1',
                        value: 'elite-1'
                    },
                    {
                        label: 'Elite',
                        value: 'elite'
                    },
                    {
                        label: 'Lead',
                        value: 'lead'
                    },
                    {
                        label: 'Guest Service',
                        value: 'guest-service'
                    }
                ]}
                onChange={ ( value ) => setAttributes({ category: value }) }
            />
        );
    },

    save( { attributes } ) {
        const { category } = attributes;

        // Rendering in PHP
        return null;
    },
} );