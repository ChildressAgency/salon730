registerBlockType( 'childress/image-links', {
    title: 'Image Links',
    icon: 'images-alt2',
    category: 'custom-blocks',

    edit( { attributes, className, setAttributes } ) {

        return (
            <div className={ className + ' image-links' }>
                <InnerBlocks
                    allowedBlocks={['childress/image-link']}
                    template={[
                        ['childress/image-link'],
                        ['childress/image-link'],
                        ['childress/image-link'],
                        ['childress/image-link']
                    ]}
                    templateLock='all'
                />
            </div>
        );
    },

    save( { attributes } ) {

        return (
            <div className="image-links">
                <InnerBlocks.Content />
            </div>
        );
    },
} );


registerBlockType( 'childress/image-link', {
    title: 'Link',
    icon: 'format-image',
    category: 'custom-blocks',
    parent: ['childress/image-links'],

    attributes: {
        backgroundImage: {
            type: 'string'
        },
        text: {
            type: 'string',
            source: 'text',
            selector: 'a'
        },
        link: {
            type: 'string',
            source: 'attribute',
            attribute: 'href',
            selector: 'a'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { backgroundImage, text, link } = attributes;

        return (
            <div className={ className + ' image-link' } style={{ backgroundImage: `url(${ backgroundImage })` }}>
                <div className='image-link__inner'>
                    <MediaUpload
                        onSelect={ media => { setAttributes({ backgroundImage: media.url }); } }
                        type="image"
                        value={ backgroundImage }
                        render={ ({ open }) => (
                            <Button className={ 'button button-large' } onClick={ open }>
                                { 'Set Background' }
                            </Button>
                        ) }
                    />
                    <URLInputButton
                        url={ link }
                        onChange={ ( url ) => { setAttributes({ link: url }) } }
                    />
                    <p>
                        <PlainText
                            value={ text }
                            onChange={ ( value ) => { setAttributes({ text: value }) } }
                        />
                    </p>
                </div>
            </div>
        );
    },

    save( { attributes } ) {
        const { backgroundImage, text, link } = attributes;

        return (
            <div className="image-link" style={{ backgroundImage: `url(${ backgroundImage })` }}>
                <a href={ link }>{ text }</a>
            </div>
        );
    },
} );


