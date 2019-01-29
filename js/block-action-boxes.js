registerBlockType( 'childress/action-boxes', {
    title: 'Action Boxes',
    icon: 'format-gallery',
    category: 'custom-blocks',

    edit( { attributes, className, setAttributes } ) {
        return(
            <div className={ className }>
                <InnerBlocks
                    allowedBlocks={['childress/action-boxes']}
                    template={[
                        ['childress/action-box'],
                        ['childress/action-box']
                    ]}
                    templateLock='all'
                />
            </div>
        );
    },

    save( { attributes } ) {
        return(
            <div className="action-boxes">
                <InnerBlocks.Content />
            </div>
        );
    },
} );

registerBlockType( 'childress/action-box', {
    title: 'Action Box',
    icon: 'format-image',
    category: 'custom-blocks',
    parent: ['childress/action-boxes'],

    attributes: {
        title: { 
            type: 'string',
            source: 'text',
            selector: 'h3'
        },
        text: {
            type: 'string',
            source: 'text',
            selector: 'p'
        },
        backgroundColor: {
            type: 'string'
        },
        backgroundImage: {
            type: 'string'
        },
        underlineColor: {
            type: 'string',
            default: '#ffffff'
        },
        textColor: {
            type: 'string',
            default: '#000000'
        }
    },

    edit( { attributes, className, setAttributes } ) {
        const { title, text, backgroundColor, backgroundImage, underlineColor, textColor } = attributes;

        function setBackgroundColor( ...args ){
            setAttributes({ backgroundColor: args[0] });
        }

        function setTextColor( ...args ){
            setAttributes({ textColor: args[0] });
        }

        function setUnderlineColor( ...args ){
            setAttributes({ underlineColor: args[0] });
        }

        return(
            <Fragment>
                <InspectorControls>
                    <PanelColorSettings
                        title="Color Settings"
                        colorSettings={[
                            {
                                value: backgroundColor,
                                onChange: setBackgroundColor,
                                label: 'Background Color'
                            },
                            {
                                value: textColor,
                                onChange: setTextColor,
                                label: 'Text Color'
                            },
                            {
                                value: underlineColor,
                                onChange: setUnderlineColor,
                                label: 'Underline Color'
                            },
                        ]}
                    />
                    <PanelBody
                        title={ 'Background Image' }>
                        <MediaUpload
                            label="Background Image"
                            onSelect={ media => { setAttributes( { backgroundImage: media.url } ) } }
                            type="image"
                            value={ backgroundImage }
                            render={ ({ open }) => (
                                <Button className={ backgroundImage ? 'image-button' : 'button button-large' } onClick={ open }>
                                    { backgroundImage ? <img src={ backgroundImage } /> : 'Select Image' }
                                </Button>
                            ) }
                        />
                    </PanelBody>
                </InspectorControls>
                <div className={ className + ' action-box'} style={{ backgroundImage: `url(${ backgroundImage })`, color: `${ textColor }` }}>
                    <div className="action-box__inner" style={{ backgroundColor: backgroundImage ? `rgba(0, 0, 0, .5)` : backgroundColor }}>
                        <h3 style={{ color: `${ textColor }` }}>
                            <PlainText
                                value={ title }
                                onChange={ ( value ) => { setAttributes({ title: value }) } }
                                placeholder="Title"
                            />
                        </h3>
                        <hr style={{ backgroundColor: underlineColor }} />
                        <p style={{ color: `${ textColor }` }}>
                            <PlainText
                                value={ text }
                                onChange={ ( value ) => { setAttributes({ text: value }) } }
                                placeholder="Text"
                            />
                        </p>
                        <InnerBlocks
                            allowedBlocks={['core/button']}
                            template={[['core/button']]}
                            templateLock='all'
                        />
                    </div>
                </div>
            </Fragment>
        );
    },

    save( { attributes } ) {
        const { title, text, backgroundColor, backgroundImage, underlineColor, textColor } = attributes;
        let bgColor;

        if( { backgroundImage } ){
            bgColor = `rgba(0, 0, 0, .5)`;
        } else {
            bgColor = { backgroundColor };
        }

        return(
            <div className="action-box" style={{ backgroundImage: `url(${ backgroundImage })`, color: `${ textColor }` }}>
                <div className="action-box__inner" style={{ backgroundColor: backgroundImage ? `rgba(0, 0, 0, .5)` : backgroundColor }}>
                    <h3 class="action-box__title" style={{ color: `${ textColor }` }}>{ title }</h3>
                    <hr style={{ backgroundColor: underlineColor }} />
                    <p style={{ color: `${ textColor }` }}>{ text }</p>
                    <InnerBlocks.Content />
                </div>
            </div>
        );
    },
} );

