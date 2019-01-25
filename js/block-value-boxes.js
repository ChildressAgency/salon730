registerBlockType( 'childress/value-boxes', {
    title: 'Value Boxes',
    icon: 'forms',
    category: 'custom-blocks',

    attributes: {
        imageUpperUrl: {
            type: 'string',
            source: 'attribute',
            attribute: 'src',
            selector: '.value-boxes__image--upper img'
        },
        imageUpperAlt: {
            type: 'string',
            source: 'attribute',
            attribute: 'alt',
            selector: '.value-boxes__image--upper img'
        },
        imageLowerUrl: {
            type: 'string',
            source: 'attribute',
            attribute: 'src',
            selector: '.value-boxes__image--lower img'
        },
        imageLowerAlt: {
            type: 'string',
            source: 'attribute',
            attribute: 'alt',
            selector: '.value-boxes__image--lower img'
        },
        imageLargeUrl: {
            type: 'string',
            source: 'attribute',
            attribute: 'src',
            selector: '.value-boxes__image--large img'
        },
        imageLargeAlt: {
            type: 'string',
            source: 'attribute',
            attribute: 'alt',
            selector: '.value-boxes__image--large img'
        },
        imageLargeHideMobile: {
            type: 'boolean',
            default: true
        },
        textUpper: {
            type: 'string',
            source: 'text',
            selector: '.value-boxes__text--upper'
        },
        textLower: {
            type: 'string',
            source: 'text',
            selector: '.value-boxes__text--lower'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { imageUpperUrl, imageUpperAlt, imageLowerUrl, imageLowerAlt, imageLargeUrl, imageLargeAlt, imageLargeHideMobile, textUpper, textLower } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody
                        title={ 'Mobile Display Options' }
                        initialOpen={ true }>
                        <ToggleControl
                            label="Hide Large Image on Mobile"
                            help={ imageLargeHideMobile ? 'Hide on Mobile' : 'Show on Mobile' }
                            checked={ imageLargeHideMobile }
                            onChange={ ( value ) => setAttributes({ imageLargeHideMobile: value }) }
                        />
                    </PanelBody>
                </InspectorControls>
                <div className={ className + ' value-boxes' }>
                    <div className="value-boxes__left">
                        <div className="value-boxes__image value-boxes__image--upper">
                            <MediaUpload
                                onSelect={ media => { setAttributes( { imageUpperUrl: media.url, imageUpperAlt: media.alt } ) } }
                                type="image"
                                value={ imageUpperUrl }
                                render={ ({ open }) => (
                                    <Button className={ imageUpperUrl ? 'image-button' : 'button button-large' } onClick={ open }>
                                        { imageUpperUrl ? <img src={ imageUpperUrl } /> : 'Select Image' }
                                    </Button>
                                ) }
                            />
                        </div>
                        <div className="value-boxes__text value-boxes__text--upper">
                            <p>
                                <PlainText
                                    value={ textUpper }
                                    onChange={ ( text ) => setAttributes({ textUpper: text }) }
                                    placeholder="Upper Text"
                                    />
                            </p>
                        </div>
                        <div className="value-boxes__text value-boxes__text--lower">
                            <p>
                                <PlainText
                                    value={ textLower }
                                    onChange={ ( text ) => setAttributes({ textLower: text }) }
                                    placeholder="Lower Text"
                                    />
                            </p>
                        </div>
                        <div className="value-boxes__image value-boxes__image--lower">
                            <MediaUpload
                                onSelect={ media => { setAttributes( { imageLowerUrl: media.url, imageLowerAlt: media.alt } ) } }
                                type="image"
                                value={ imageLowerUrl }
                                render={ ({ open }) => (
                                    <Button className={ imageLowerUrl ? 'image-button' : 'button button-large' } onClick={ open }>
                                        { imageLowerUrl ? <img src={ imageLowerUrl } /> : 'Select Image' }
                                    </Button>
                                ) }
                            />
                        </div>
                    </div>
                    <div className="value-boxes__right value-boxes__image value-boxes__image--large">
                        <MediaUpload
                            onSelect={ media => { setAttributes( { imageLargeUrl: media.url, imageLargeAlt: media.alt } ) } }
                            type="image"
                            value={ imageLargeUrl }
                            render={ ({ open }) => (
                                <Button className={ imageLargeUrl ? 'image-button' : 'button button-large' } onClick={ open }>
                                    { imageLargeUrl ? <img src={ imageLargeUrl } /> : 'Select Image' }
                                </Button>
                            ) }
                        />
                    </div>
                </div>
            </Fragment>
        );
    },

    save( { attributes } ) {
        const { imageUpperUrl, imageUpperAlt, imageLowerUrl, imageLowerAlt, imageLargeUrl, imageLargeAlt, imageLargeHideMobile, textUpper, textLower } = attributes;

        var hide_mobile = '';

        if( imageLargeHideMobile )
            hide_mobile = 'hide-mobile';

        return (
            <div className="value-boxes">
                <div className="value-boxes__left">
                    <div className="value-boxes__image value-boxes__image--upper">
                        <img src={ imageUpperUrl } alt={ imageUpperAlt } />
                    </div>
                    <div className="value-boxes__text value-boxes__text--upper">
                        <p>{ textUpper }</p>
                    </div>
                    <div className="value-boxes__image value-boxes__image--lower">
                        <img src={ imageLowerUrl } alt={ imageLowerAlt } />
                    </div>
                    <div className="value-boxes__text value-boxes__text--lower">
                        <p>{ textLower }</p>
                    </div>
                </div>
                <div className={ "value-boxes__right value-boxes__image value-boxes__image--large " + hide_mobile }>
                    <img src={ imageLargeUrl } alt={ imageLargeAlt } />
                </div>
            </div>
        );
    },
} );
