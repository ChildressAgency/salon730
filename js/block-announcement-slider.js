registerBlockType( 'childress/announcement-slider', {
    title: 'Announcement Slider',
    icon: 'format-gallery',
    category: 'custom-blocks',

    edit( { attributes, className, setAttributes } ) {
        return (
            <div className={ className }>
                <InnerBlocks
                    allowedBlocks={['childress/announcement-slide']}
                    template={[['childress/announcement-slide']]}
                />
            </div>
        );
    },

    save( { attributes } ) {
        return (
            <div>
                <div className="slick-arrow--next">&gt;</div>
                <div className="slick-arrow--prev">&lt;</div>
                <div className="announcement-slider">
                    <InnerBlocks.Content />
                </div>
            </div>
        );
    },
} );

registerBlockType( 'childress/announcement-slide', {
    title: 'Slide',
    icon: 'format-image',
    category: 'custom-blocks',
    parent: ['childress/announcement-slider'],

    attributes: {
        backgroundColor1: {
            type: 'string',
            default: '#8bc53f'
        },
        backgroundColor2: {
            type: 'string',
            default: '#8bc53f'
        },
        textColor: {
            type: 'string',
            default: '#000000'
        },
        text: {
            type: 'string'
        },
        imageUrl: {
            type: 'string',
            source: 'attribute',
            attribute: 'src',
            selector: 'img'
        },
        imageAlt: {
            type: 'string',
            source: 'attribute',
            attribute: 'alt',
            selector: 'img'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { backgroundColor1, backgroundColor2, textColor, text, imageUrl, imageAlt } = attributes;

        function setBackground1( ...args ){
            setAttributes({ backgroundColor1: args[0] });
        }

        function setBackground2( ...args ){
            setAttributes({ backgroundColor2: args[0] });
        }

        function setTextColor( ...args ){
            setAttributes({ textColor: args[0] });
        }

        return (
            <Fragment>
                <InspectorControls>
                    <PanelColorSettings
                        title="Color Settings"
                        colorSettings={[
                            {
                                value: backgroundColor1,
                                onChange: setBackground1,
                                label: 'Background Color 1'
                            },
                            {
                                value: backgroundColor2,
                                onChange: setBackground2,
                                label: 'Background Color 2'
                            },
                            {
                                value: textColor,
                                onChange: setTextColor,
                                label: 'Text Color'
                            },
                        ]}
                    />
                </InspectorControls>
                <div className={ className } style={{ background: `linear-gradient( to right, ${ backgroundColor1 }, ${ backgroundColor2 } )`, color: `${ textColor }` }}>
                    <p>
                        <PlainText
                            value={ text }
                            onChange={ ( value ) => { setAttributes({ text: value }) } }
                            placeholder="Text"
                        />
                    </p>
                    <MediaUpload
                        onSelect={ media => { setAttributes( { imageUrl: media.url, imageAlt: media.alt } ) } }
                        type="image"
                        value={ imageUrl }
                        render={ ({ open }) => (
                            <Button className={ imageUrl ? 'image-button' : 'button button-large' } onClick={ open }>
                                { imageUrl ? <img src={ imageUrl } /> : 'Select Image' }
                            </Button>
                        ) }
                    />
                </div>
            </Fragment>
        );
    },

    save( { attributes } ) {
        const { backgroundColor1, backgroundColor2, textColor, text, imageUrl, imageAlt } = attributes;

        return (
            <div className="slide" style={{ background: `linear-gradient( to right, ${ backgroundColor1 }, ${ backgroundColor2 } )`, color: `${ textColor }` }}>
                <div className="container container--thin">
                    <p>{ text }</p>
                    <img src={ imageUrl } alt={ imageAlt } />
                </div>
            </div>
        );
    },
} );

