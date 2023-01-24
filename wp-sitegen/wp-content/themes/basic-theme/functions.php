<?php

// Enqueuing
function load_css()
{
    wp_enqueue_style('main', get_stylesheet_uri(), null, microtime());

    wp_enqueue_style('style_features', get_stylesheet_directory_uri() . '/css/style_features.css', null, microtime());
    
    wp_enqueue_style('style_comparation', get_stylesheet_directory_uri() . '/css/style_comparation.css', null, microtime());
    
    wp_enqueue_style('style_form', get_stylesheet_directory_uri() . '/css/style_form.css', null, microtime());
    
    wp_enqueue_style('style_header', get_stylesheet_directory_uri() . '/css/style_header.css', null, microtime());
    
    wp_enqueue_style('media_new', get_stylesheet_directory_uri() . '/css/media.css', null, microtime());
    
    wp_enqueue_style('style_footer', get_stylesheet_directory_uri() . '/css/style_footer.css', null, microtime());
    
    wp_enqueue_style('style_pictext', get_stylesheet_directory_uri() . '/css/style_pictext.css', null, microtime());
    
    wp_enqueue_style('normalize_new', get_stylesheet_directory_uri() . '/css/normalize.css', null, microtime());
}
add_action('wp_enqueue_scripts', 'load_css');

function load_js()
{
    wp_enqueue_script('jquery');

    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], 1, true);
    wp_enqueue_script('bootstrap');
    
    wp_enqueue_script('row_edit', get_template_directory_uri() . '/js/row.js', null, microtime());
    
    wp_enqueue_script('header_wrap', get_template_directory_uri() . '/js/header_wrap.js', null, microtime());
}
add_action('wp_enqueue_scripts', 'load_js');


// Nav Menus
register_nav_menus( array(
    'top-menu' => __( 'Top Menu', 'theme' ),
    'footer-menu' => __( 'Footer Menu', 'theme' ),
) );

// Theme Support
add_theme_support('menus');
add_theme_support( 'post-thumbnails' );

// Image Sizes
add_image_size('small', 600, 600, false);
function remove_editor() {
  remove_post_type_support('page', 'editor');
}
add_action('admin_init', 'remove_editor');
/**
 * Define the metabox and field configurations.
 */
function cmb2_render_callback_for_text_number( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'type' => 'number', 'min' => '8') );
}
add_action( 'cmb2_render_text_number', 'cmb2_render_callback_for_text_number', 10, 5 );

//function cmb2_render_callback_for_pic_text_number( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
//    echo $field_type_object->input( array( 'type' => 'number', 'min' => '0') );
//}
//add_action( 'cmb2_render_pic_text_number', 'cmb2_render_callback_for_pic_text_number', 10, 5 );

function cmb2_render_callback_for_pic_range_input( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'type' => 'range', 'max' => '50', 'min' => '0', 'step' => '10') );
}
add_action( 'cmb2_render_pic_range_input', 'cmb2_render_callback_for_pic_range_input', 10, 5 );

function cmb2_render_callback_for_border_range_input( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'type' => 'range', 'max' => '100', 'min' => '0') );
}
add_action( 'cmb2_render_border_range_input', 'cmb2_render_callback_for_border_range_input', 10, 5 );

function cmb2_render_callback_for_row_number( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'type' => 'number', 'max' => '100', 'min' => '1') );
}
add_action( 'cmb2_render_row_number', 'cmb2_render_callback_for_row_number', 10, 5 );

function cmb2_render_callback_for_max_width( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'type' => 'number', 'min' => '320') );
}
add_action( 'cmb2_render_max_width', 'cmb2_render_callback_for_max_width', 10, 5 );

function metaboxes(){
    
    $cmb = new_cmb2_box( array(
    'id'            => 'metabox2',
    'title'         => __( 'Метабокс для создания блоков', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'context'       => 'normal',
    'priority'      => 'low',
    'show_names'    => true,// Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
    ) );
    
    $cmb_globalset = new_cmb2_box( array(
    'id'            => 'metabox1',
    'title'         => __( 'Глобальные настройки', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'context'       => 'normal',
    'priority'      => 'core',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
    ) );
    
    $cmb_bottom = new_cmb2_box( array(
    'id'            => 'metabox3',
    'title'         => __( 'Настройки нижней части сайта', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'context'       => 'normal',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
    ) );
    
        
    $cmb_header = new_cmb2_box( array(
    'id'            => 'metabox4',
    'title'         => __( 'Настройка шапки сайта', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'context'       => 'normal',
    'show_names'    => true, // Show field names on the left
    // 'cmb_styles' => false, // false to disable the CMB stylesheet
    // 'closed'     => true, // Keep the metabox closed by default
    ) );
    
//    $cmb_globalset->add_field(array(
//    'name'             => 'Размер промежутка',
//    'desc'             => 'промежуток между блоками',
//    'id'               => 'gap_size',
//    'type'             => 'pic_text_number',
//    'default'          => '',
//    'attributes' => array(
//        'placeholder' => '12',
//    ),
//    ));
    
    $cmb_globalset->add_field(array(
    'name'             => 'Шрифт',
    'id'               => 'font_selector',
    'type'             => 'select',
    'default'          => 'arial',
    'options'          => array(
        'courier_new' => __( 'Corier New', 'cmb2' ),
        'franklin_gothic_medium' => __( 'Franklin Gothic Medium', 'cmb2' ),
        'gill_sans' => __( 'Gill Sans', 'cmb2' ),
        'lucida_sans' => __( 'Lucida Sans', 'cmb2' ),
        'segoe' => __( 'Segoe', 'cmb2' ),
        'times_new_roman' => __( 'Times New Roman', 'cmb2' ),
        'trebuchet' => __( 'Trebuchet', 'cmb2' ),
        'arial' => __( 'Arial', 'cmb2' ),
        'cambria' => __( 'Cambria', 'cmb2' ),
        'georgia' => __( 'Georgia', 'cmb2' ),
        'impact' => __( 'Impact', 'cmb2' ),
        'verdana' => __( 'Verdana', 'cmb2' ),
    ), ));
    
    $cmb_globalset->add_field(array(
    'name'    => 'Цвет фона',
    'id'      => 'color_pic_back',
    'type'    => 'colorpicker',
    'default' => '#ffffff',
    ));
    
    $cmb_globalset->add_field(array(
    'name'    => 'Максимальная ширина контейнера',
    'id'      => 'container_width',
    'type'    => 'max_width',
    'desc'    => 'Значение по умолчанию 1920px',
    ));
    
//    $cmb_globalset->add_field(array(
//    'name'    => 'Картинка',
//    'desc'    => 'Вставьте ссылку на изображение или добавьте по кнопке',
//    'id'      => 'img_global',
//    'type'    => 'file',
//    // Optional:
//    'options' => array(
//        'url' => true, // Hide the text input for the url
//    ),
//    'text'    => array(
//        'add_upload_file_text' => 'Добавить картинку',
//    ),
//    // query_args are passed to wp.media's library query.
//    'query_args' => array(
//        'type' => array('image/jpeg', 'image/png',),
//    ),
//    'preview_size' => 'medium', // Image size to use when previewing in the admin.
//    ) );
    
    $group_field_id = $cmb->add_field( array(
    'id'          => 'test_group',
    'type'        => 'group',
    'description' => __( '', 'cmb2' ),
    'repeatable'  => true, // use false if you want non-repeatable group
    'options'     => array(
        'group_title'       => __( 'Форма {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
        'add_button'        => __( 'Добавить новую форму', 'cmb2' ),
        'remove_button'     => __( 'Удалить форму', 'cmb2' ),
        'sortable'          => true,
        'remove_confirm' => esc_html__( 'Вы точно хотите удалить форму?', 'cmb2' ), // Performs confirmation before removing group.
    ),));
    
    $cmb->add_group_field($group_field_id, array(
    'name'             => 'Шаблон блока',
    'desc'             => 'Выберите шаблон',
    'id'               => 'template_selector',
    'type'             => 'select',
    'options'          => array(
        'text_block' => __( 'Текст', 'cmb2' ),
        'pic'   => __( 'Изображение', 'cmb2' ),
        'imgtext' => __('Изображение с текстом', 'cmb2'),
        'video' => __('Видео (файл)', 'cmb2'),
        'video_emb' => __('Видео (ссылка на сайт)', 'cmb2'),
        'features' => __('Преимущества', 'cmb2'),
        'comprastion' => __('Сравнения', 'cmb2'),
    ), ));
    //START----------------------------------------------------------------IMGTEXT--------------------------------------------------------------------------------START
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Шаблон',
    'id'      => 'imgtext_selector',
    'desc'    => 'Выберите шаблон',
    'type'    => 'radio_inline',
    'default' => 'left',
    'attributes' => array(
        'required'               => true,
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('imgtext')),
    ),
    'options' => array(
        'left'      => __( 'Картинка слева', 'cmb2' ),
        'right' => __( 'Картинка справа', 'cmb2' ),
    ),
    ) );
    //END----------------------------------------------------------------IMGTEXT--------------------------------------------------------------------------------END
    //START----------------------------------------------------------------Text-------------------------------------------------------------------------START
    $cmb -> add_group_field($group_field_id, array(
        'name'    => 'Нужен ли заголовок',
        'desc'    => 'Разделить на заголовок и описание',
        'id'      => 'need_split_text',
        'type'    => 'checkbox',
        'attributes' => array(
			'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('text_block', 'imgtext')),
		),
    ),);
    $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Текст', 'cmb2' ),
        'id'         => 'text_block_textbox',
        'desc'       => 'Разделение заголовка и описания происходит по <strong>первому</strong> переносу строки',
        'type'       => 'textarea',
        'attributes' => array(
			'required'               => true, // Will be required only if visible.
			'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('text_block', 'imgtext')),
		),
        ) );
        $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Размер текста', 'cmb2' ),
        'id'         => 'text_block_size',
        'type'       => 'text_number',
        'desc'       => 'Минимальное значение 8',
        'attributes' => array(
            'placeholder' => '12',
			'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('text_block', 'imgtext')),
		),
        ) );
    
    $cmb->add_group_field($group_field_id, array(
        'name'             => 'Выравниевание текста',
        'id'               => 'text_block_align_selector',
        'type'             => 'select',
        'default'          => 'start',
        'options'          => array(
            'start' => __( 'По левому край', 'cmb2' ),
            'center' => __( 'По центру', 'cmb2' ),
            'end' => __( 'По правому край', 'cmb2' ),
            'wide' => __( 'По ширине', 'cmb2' ),
        ),
        'attributes' => array(
            'placeholder' => '12',
			'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('text_block', 'imgtext')),
		),
        ));
    //END-------------------------------------------------------------------Text---------------------------------------------------------------------------END
    //START-------------------------------------------------------------------OEMBED---------------------------------------------------------------------------START
    $cmb->add_group_field($group_field_id, array(
    'name' => 'Ссылка',
    'desc' => 'Вставьте ссылку на сайт. Поддерживате сайты из этого <a href="https://codex.wordpress.org/%D0%92%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0_%D0%BE%D0%B1%D1%8A%D0%B5%D0%BA%D1%82%D0%BE%D0%B2">списка</a>.',
    'id'   => 'embed',
    'type' => 'oembed',
     'attributes' => array(
        'required'               => true, // Will be required only if visible.
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('video_emb')),
    ),
    ) );
    //END-------------------------------------------------------------------OEMBED---------------------------------------------------------------------------END
    //START----------------------------------------------------------------IMAGE--------------------------------------------------------------------------------START
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Картинка',
    'desc'    => 'Вставьте ссылку на изображение или добавьте по кнопке',
    'id'      => 'pic_imgbox',
    'type'    => 'file',
    'attributes' => array(
        'required'               => true, // Will be required only if visible.
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('pic', 'imgtext')),
    ),
    // Optional:
    'options' => array(
        'url' => true, // Hide the text input for the url
    ),
    'text'    => array(
        'add_upload_file_text' => 'Добавить картинку',
    ),
    // query_args are passed to wp.media's library query.
    'query_args' => array(
        'type' => array('image/jpeg', 'image/png','image/svg'),
    ),
    'preview_size' => 'medium', // Image size to use when previewing in the admin.
    ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Отразить изображение',
    'id'      => 'pic_mirror',
    'type'    => 'select',
    'show_option_none' => true,
    'default' => '',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('pic', 'imgtext')),
    ),
    'options' => array(
        'horizontal'      => __( 'Горизонталь', 'cmb2' ),
        'vertical'        => __( 'Вертикаль', 'cmb2' ),
    ),
    ) );
//    $cmb->add_group_field($group_field_id, array(
//        'name'       => __( 'Масштаб изображения', 'cmb2' ),
//        'id'         => 'pic_scale',
//        'type'       => 'pic_text_number',
//        'attributes' => array(
//            'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
//            'data-conditional-value' => "pic",
//        ),
//        ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Сферичность',
    'desc'    => 'Сферичность изображения (радиус границы)',
    'id'      => 'pic_radius',
    'type'    => 'pic_range_input',
    'show_option_none' => true,
    'default' => '0',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('pic', 'imgtext')),
    ),
    ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Толщина рамки',
    'desc'    => 'Толщина рамки изображения (если нулевая, то её не будет)',
    'id'      => 'pic_border_width',
    'type'    => 'border_range_input',
    'show_option_none' => true,
    'default' => '0',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('pic', 'imgtext')),
    ),
    ) );
    //END----------------------------------------------------------------------IMAGE------------------------------------------------------------------------------END
    //START----------------------------------------------------------------------VIDEO------------------------------------------------------------------------------START
//    $cmb->add_group_field($group_field_id, array(
//    'name'    => 'Шаблон видео',
//    'id'      => 'video_radio',
//    'desc'    => 'Выберите шаблон для видео',
//    'type'    => 'radio_inline',
//    'default' => 'vid',
//    'attributes' => array(
//        'required'               => true,
//        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
//        'data-conditional-value' => wp_json_encode(array('aboba')),
//    ),
//    'options' => array(
//        'oe'      => __( 'Ссылка на сайт(oembed)', 'cmb2' ),
//        'vid' => __( 'Файл', 'cmb2' ),
//    ),
//    ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Опции видео',
    'id'      => 'vid_style',
    'type'    => 'multicheck',
    'desc'    => 'Если включено автовоспроизведение, то видео будет без звука',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('video')),
    ),
    'options' => array(
        'loop'      => __( 'Зацикленное', 'cmb2' ),
        'muted' => __( 'Заглушенное', 'cmb2' ),
        'autoplay' => __( 'Автовоспроизведение', 'cmb2' ),
    ),
    'default' => 'bold',
    ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Обложка для видео',
    'id'      => 'vid_cover',
    'type'    => 'file',
    'attributes' => array(
        'required'               => true, // Will be required only if visible.
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('video')),
    ),
    'text'    => array(
        'add_upload_file_text' => 'Добавить картинку',
    ),
    'query_args' => array(
        'type' => array('image/jpeg', 'image/png', 'image/svg',),
    ),
    'preview_size' => 'medium',
    ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Видео файл',
    'desc'    => 'Вставьте ссылку на видео или добавьте по кнопке',
    'id'      => 'vid_file',
    'type'    => 'file',
    'attributes' => array(
        'required'               => true, // Will be required only if visible.
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('video')),
    ),
    'text'    => array(
        'add_upload_file_text' => 'Добавить видео',
    ),
    'query_args' => array(
        'type' => 'video',
    ),
    'preview_size' => 'medium',
    ) );
    //END----------------------------------------------------------------------VIDEO------------------------------------------------------------------------------END
    //START----------------------------------------------------------------------FEATURES------------------------------------------------------------------------------START
    $cmb->add_group_field($group_field_id, array(
    'name'             => 'Шаблон преимуществ',
    'id'               => 'template_features',
    'type'             => 'radio',
    'default'          => 'feature1',
    'options'          => array(
        'feature1' => __( '', 'cmb2' ),
        'feature2'   => __( '', 'cmb2' ),
        'feature3' => __('', 'cmb2'),
    ),
    'attributes' => array(
        'required'               => true, // Will be required only if visible.
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('features')),
    ),));
    
    $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Заголовок пред списком', 'cmb2' ),
        'desc'       => 'Разделение заголовка и описания происходит по <strong>первому</strong> переносу строки',
        'id'         => 'feature_header',
        'type'       => 'textarea',
        'attributes' => array(
			'required'               => true, // Will be required only if visible.
			'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('features')),
		),
    ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Размер текста',
    'id'      => 'features_size',
    'type'    => 'text_number',
    'desc'       => 'Минимальное значение 8',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('features')),
        'placeholder' => 12,
    ),));
    $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Список преимуществ', 'cmb2' ),
        'desc'       => 'Разделение заголовка и описания происходит по <strong>первому</strong> переносу строки',
        'id'         => 'feature_list',
        'type'       => 'textarea',
        'repeatable'  => true,
    ) );
    $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Число элеменов в строке', 'cmb2' ),
        'id'         => 'row_num_features',
        'type'       => 'row_number',
        'attributes' => array(
            'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('features')),
            'placeholder' => 3,
    ) ));
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Картинка',
    'desc'    => 'Вставьте ссылку на изображение или добавьте по кнопке',
    'id'      => 'pic_features',
    'type'    => 'file',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('features')),
    ),
    'query_args' => array(
        'type' => array('image/jpeg', 'image/png','image/svg',),)
    ,));
    //END----------------------------------------------------------------------FEATURES------------------------------------------------------------------------------END
    //START----------------------------------------------------------------------COMPARATION------------------------------------------------------------------------------START
    $cmb->add_group_field($group_field_id, array(
        'name'             => 'Шаблон сравнений',
        'id'               => 'template_comprastion',
        'type'             => 'radio',
        'default'          => 'comprastion1',
        'options'          => array(
            'comprastion1' => __( '', 'cmb2' ),
            'comprastion2'   => __( '', 'cmb2' ),
        ),
        'attributes' => array(
            'required'               => true, // Will be required only if visible.
            'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('comprastion')),
    ),));
    
    $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Заголовок пред списком', 'cmb2' ),
        'id'         => 'comprastion_header',
        'type'       => 'textarea',
        'attributes' => array(
			'required'               => true, // Will be required only if visible.
            'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('comprastion')),
		),
    ) );
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Размер текста',
    'id'      => 'comprastion_size',
    'type'    => 'text_number',
    'desc'       => 'Минимальное значение 8',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('comprastion')),
        'placeholder' => 12,
    ),));
    $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Список сравнений', 'cmb2' ),
        'desc'       => 'Разделение заголовка и описания происходит по <strong>первому</strong> переносу строки',
        'id'         => 'comprastion_list',
        'type'       => 'textarea',
        'repeatable'  => true,
    ) );
    $cmb->add_group_field($group_field_id, array(
        'name'       => __( 'Число элеменов в строке', 'cmb2' ),
        'id'         => 'row_num_comprastion',
        'type'       => 'row_number',
        'attributes' => array(
            'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('comprastion')),
            'placeholder' => 3,
    ) ));
    $cmb->add_group_field($group_field_id, array(
        'name'    => 'Картинки',
        'desc'    => 'Добавьте по кнопке',
        'id'      => 'pic_comprastion',
        'type'    => 'file_list',
        'preview_size' => array( 200, 200 ),
        'attributes' => array(
            'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('comprastion')),
    ),
    'query_args' => array(
        'type' => array('image/jpeg', 'image/png','image/svg',),)
    ,));
    //END----------------------------------------------------------------------COMPARATION------------------------------------------------------------------------------END
    //START----------------------------------------------------------------------UNIQUE------------------------------------------------------------------------------START
    $cmb_bottom -> add_field(array(
        'name'    => 'Отображение формы',
        'id'      => 'need_form',
        'type'    => 'checkbox',
    ),);
    
    $cmb_bottom -> add_field(array(
        'name'             => 'Шаблон формы',
        'id'               => 'form_selector',
        'type'             => 'radio',
        'default'          => 'form1',
        'options'          => array(
            'form1'            => __( '', 'cmb2' ),
            'form2'            => __( '', 'cmb2' ),
    ),
    ));
    
    $cmb_bottom -> add_field(array(
        'name'             => 'Ссылка для формы',
        'id'               => 'form_link',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой для перехода на эту же страницу',
    ));
    
    $cmb_header -> add_field(array(
        'name'    => 'Отображение шапки сайта',
        'id'      => 'need_header',
        'type'    => 'checkbox',
    ),);
    
    $cmb_header -> add_field(array(
        'name'    => 'Логотип шапки сайта',
        'desc'    => 'Добавьте по кнопке или вставьте ссылку',
        'id'      => 'logo_header',
        'type'    => 'file',
        'preview_size' => array( 200, 200 ),
        'query_args' => array(
        'type' => array('image/jpeg', 'image/png', 'image/svg',),)
    ),);
    
    $cmb_header -> add_field(array(
        'name'    => 'Цвет шапки сайта',
        'id'      => 'colorpicker_head',
        'type'    => 'colorpicker',
        'default' => '#000000',
    ));
    
    $cmb_header -> add_field(array(
        'name'    => 'Цвет текста в шапке сайта',
        'id'      => 'colorpicker_head_text',
        'type'    => 'colorpicker',
        'default' => '#ffffff',
    ));
    
    $cmb_header -> add_field(array(
        'name'             => 'Кнопки шапки сайта',
        'id'               => 'header_links',
        'type'             => 'textarea',
        'desc'             => 'Напишите название кнопки и через перенос строки Id блока (одна форма, одна кнопка)',
        'repeatable'       => 'true',
    ));
    
    $cmb_bottom -> add_field(array(
        'name'    => 'Отображение подвала сайта',
        'id'      => 'need_footer',
        'type'    => 'checkbox',
    ),);
    
    $cmb_bottom -> add_field(array(
        'name'    => 'Цвет подвала сайта',
        'id'      => 'colorpicker_footer',
        'type'    => 'colorpicker',
        'default' => '#000000',
    ));
    
    $cmb_bottom -> add_field(array(
        'name'    => 'Цвет иконок подвала сайта',
        'id'      => 'colorpicker_footer_icon',
        'type'    => 'colorpicker',
        'default' => '#ffffff',
    ));
    
    $cmb_bottom -> add_field(array(
        'name'             => 'Ссылка на Вк',
        'id'               => 'link1',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой, и иконка не будет отображаться',
    ));
    
    $cmb_bottom -> add_field(array(
        'name'             => 'Ссылка на facebook',
        'id'               => 'link2',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой, и иконка не будет отображаться',
    ));
    
    $cmb_bottom -> add_field(array(
        'name'             => 'Ссылка на YouTube',
        'id'               => 'link3',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой, и иконка не будет отображаться',
    ));
    
    $cmb_bottom -> add_field(array(
        'name'             => 'Ссылка на Instagram',
        'id'               => 'link4',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой, и иконка не будет отображаться',
    ));
    
    $cmb_bottom -> add_field(array(
        'name'             => 'Ссылка на Telegram',
        'id'               => 'link5',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой, и иконка не будет отображаться',
    ));
    
        $cmb_bottom-> add_field(array(
        'name'             => 'Ссылка на Твиттер',
        'id'               => 'link6',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой, и иконка не будет отображаться',
    ));
    
    $cmb_bottom-> add_field(array(
        'name'             => 'Ссылка на Однокласники',
        'id'               => 'link7',
        'type'             => 'text',
        'desc'             => 'Оставьте пустой, и иконка не будет отображаться',
    ));
    //END----------------------------------------------------------------------UNIQUE------------------------------------------------------------------------------END
    //START----------------------------------------------------------------------GENERAL------------------------------------------------------------------------------START
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Стиль текста',
    'id'      => 'style_radio',
    'type'    => 'multicheck',
    'attributes' => array(
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('text_block', 'imgtext')),
    ),
    'options' => array(
        'bold'      => __( 'Жирный', 'cmb2' ),
        'italic' => __( 'Италик', 'cmb2' ),
        'underline' => __( 'Подчёркивание', 'cmb2' ),
        'uppercase' => __( 'КАПС', 'cmb2' ),
    ),
    ) );
    
    $cmb->add_group_field($group_field_id, array(
    'name'    => 'Цвет',
    'id'      => 'colorpicker',
    'type'    => 'colorpicker',
    'default' => '#000000',
    'attributes' => array(
        'required'               => true, // Will be required only if visible.
        'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
        'data-conditional-value' => wp_json_encode(array('text_block', 'pic', 'imgtext')),
    ),));
    
    $cmb->add_group_field($group_field_id, array(
        'name'             => 'Id блока',
        'id'               => 'block_id',
        'type'             => 'text',
        'desc'             => 'Нужен для привязки якоря в шапке сайта',
        'attributes' => array(
            'data-conditional-id'    => wp_json_encode( array( $group_field_id, 'template_selector' ) ),
            'data-conditional-value' => wp_json_encode(array('text_block', 'pic', 'imgtext', 'video', 'features', 'comprastion')),
    ),));
    
}

add_action( 'cmb2_admin_init', 'metaboxes' );