registerBlockType( 'childress/hero-box', {
    title: 'Hero Box',
    icon: 'format-image',
    category: 'custom-blocks',

    attributes: {
        backgroundUrl: {
            type: 'string'
        },
        backgroundId: {
            type: 'number'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { backgroundUrl, backgroundId } = attributes;

        return (
            <div className={ className }>
                <div className="hero-box"
                    style={{ 
                        backgroundImage: `url(${ backgroundUrl })`,
                        padding: '15px'
                    }} >
                    <MediaUpload
                        onSelect={ media => { setAttributes({ backgroundUrl: media.url, backgroundId: media.id }); } }
                        type="image"
                        value={ backgroundId }
                        render={ ({ open }) => (
                            <Button className={ 'button button-large' } onClick={ open }>
                                { 'Set Background' }
                            </Button>
                        ) }
                    />
                    <div className="hero-box__inner">
                        <InnerBlocks />
                    </div>
                </div>
            </div>
        );
    },

    save( { attributes } ) {
        const { backgroundUrl, backgroundId } = attributes;

        return (
            <div style={{ backgroundImage: `url(${ backgroundUrl })` }}>
                <div className="hero-box">
                    <div class="hero-box__inner">
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
        );
    },
} );
