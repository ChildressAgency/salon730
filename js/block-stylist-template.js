registerBlockType( 'childress/stylist-template', {
    title: 'Stylist Template',
    icon: 'welcome-write-blog',
    category: 'custom-blocks',
    parent: false,

    attributes: {
        fullName: {
            type: 'string'
        },
        title: {
            type: 'string'
        },
        desc: {
            type: 'string'
        },
        imageUrl: {
            type: 'string'
        },
        imageAlt: {
            type: 'string'
        },
        appointmentUrl: {
            type: 'string'
        },
        instaToken: {
            type: 'string'
        },
        instaUrl: {
            type: 'string'
        }
    },

    edit( { attributes, className, setAttributes } ){
        const { fullName, title, desc, imageUrl, imageAlt, appointmentUrl, instaToken, instaUrl } = attributes;

        return (
            <div className={ className }>
                <MediaUpload
                    label="Image"
                    onSelect={ media => { setAttributes( { imageUrl: media.url } ) } }
                    type="image"
                    value={ imageUrl }
                    render={ ({ open }) => (
                        <Button className={ imageUrl ? 'image-button' : 'button button-large' } onClick={ open }>
                            { imageUrl ? <img src={ imageUrl } /> : 'Select Image' }
                        </Button>
                    ) }
                />
                <h2>
                    <PlainText
                        value={ fullName }
                        onChange={ ( value ) => { setAttributes({ fullName: value }) } }
                        placeholder="Full Name"
                    />
                </h2>
                <h4>
                    <PlainText
                        value={ title }
                        onChange={ ( value ) => { setAttributes({ title: value }) } }
                        placeholder="Title"
                    />
                </h4>
                <p>
                    <RichText
                        value={ desc }
                        onChange={ ( value ) => { setAttributes({ desc: value }) } }
                        placeholder="Description"
                    />
                </p>
                <p>
                    <TextControl
                        label="Instagram Access Token"
                        value={ instaToken }
                        onChange={ ( value ) => { setAttributes({ instaToken: value }) } }
                        placeholder="Instagram Access Token"
                    />
                </p>
                <p>
                    <TextControl
                        label="Instagram Url"
                        value={ instaUrl }
                        onChange={ ( value ) => { setAttributes({ instaUrl: value }) } }
                        placeholder="Instagram Url"
                    />
                </p>
                <p>
                    <TextControl
                        label="Appointment Url"
                        value={ appointmentUrl }
                        onChange={ ( value ) => { setAttributes({ appointmentUrl: value }) } }
                        placeholder="Appointment Url"
                    />
                </p>
            </div>
        );
    },

    save( { attributes } ) {
        return null;
    },
} );