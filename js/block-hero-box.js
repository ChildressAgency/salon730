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
        },
        backgroundPosX: {
            type: 'number',
            default: 50
        },
        backgroundPosY: {
            type: 'number',
            default: 50
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { backgroundUrl, backgroundId, backgroundPosX, backgroundPosY } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody
                        title="Background Position">
                        <RangeControl
                            label="Background X Position"
                            value={ backgroundPosX }
                            onChange={ ( value ) => { setAttributes({ backgroundPosX: value }) } }
                            min={ 0 }
                            max={ 100 }
                        />
                        <RangeControl
                            label="Background Y Position"
                            value={ backgroundPosY }
                            onChange={ ( value ) => { setAttributes({ backgroundPosY: value }) } }
                            min={ 0 }
                            max={ 100 }
                        />
                        <p>A lower number means "closer to the top/left corner". (e.g. Y = 20 is a higher position than Y = 80)</p>
                    </PanelBody>
                </InspectorControls>
                <div className={ className } style={{ backgroundImage: `url(${ backgroundUrl })` }}>
                    <div className="hero-box">
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
            </Fragment>
        );
    },

    save( { attributes } ) {
        const { backgroundUrl, backgroundId, backgroundPosX, backgroundPosY } = attributes;

        return (
            <div style={{ backgroundImage: `url(${ backgroundUrl })`, backgroundPosition: `${ backgroundPosX }% ${ backgroundPosY }%` }}>
                <div className="hero-box">
                    <div class="hero-box__inner">
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
        );
    },
} );
