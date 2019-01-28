registerBlockType( 'childress/insta-feed', {
    title: 'Instagram Feed',
    icon: 'images-alt',
    category: 'custom-blocks',

    edit( { attributes, className, setAttributes } ) {
        return(
            <p>Instagram Feed</p>
        );
    },

    save( { attributes } ) {
        return null;
    },
} );
