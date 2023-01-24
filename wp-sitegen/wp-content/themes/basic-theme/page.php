<?php
get_header();

function splitByNewChapter($str){
    $temp = explode("<br />",$str,2);
    return $temp;
}

function fillUpTo($arr,$lim,$val){
    while (count($arr) < $lim){
        $arr[] = $val;
    }
    return $arr;
}

if(get_post_meta( get_the_ID(), "need_header", 1)){
$buttons = get_post_meta( get_the_ID(), "header_links", true);
$color_head = get_post_meta( get_the_ID(), "colorpicker_head", true);
$picture_head = get_post_meta( get_the_ID(), "logo_header", true);
$color_head_text = get_post_meta( get_the_ID(), "colorpicker_head_text", true);
echo "<header class='header section_gap'>
        <div class='container header--container'>
            <img class='header__logo' src='{$picture_head}' alt=''>
            <nav class='header__nav'>
                <ul class='list--reset nav'>";
if(gettype($buttons) != 'string'){
foreach( $buttons as $bton ){
    $text = splitByNewChapter(nl2br($bton));
    $text = fillUpTo($text,2," ");
    echo "<li class='nav__item'><a href='#{$text[1]}'>{$text[0]}</a></li>";
}}
else{
    $text = splitByNewChapter(nl2br($buttons));
    $text = fillUpTo($text,2," ");
    echo "<li class='nav__item'><a href='#{$text[1]}'>{$text[0]}</a></li>";
}
echo "</ul>
            </nav>
            <button class='header__burger'>
                <span class='burger__line'></span>
                <span class='burger__line'></span>
                <span class='burger__line'></span>
            </button>
        </div>
    </header>";
echo "<script type='text/javascript'>
SetDocProperty('--header-back-color','{$color_head}');
SetDocProperty('--header-color','{$color_head_text}');
</script>";
};
$color_footer = get_post_meta( get_the_ID(), "colorpicker_footer", true);
$color_footer_icon = get_post_meta( get_the_ID(), "colorpicker_footer_icon", true);
$entries = get_post_meta( get_the_ID(), 'test_group', true );
$gap = get_post_meta( get_the_ID(), 'gap_size', true );
$font = get_post_meta( get_the_ID(), 'font_selector', true);
$col = get_post_meta( get_the_ID(), 'color_pic_back', true);
$form_type = get_post_meta( get_the_ID(), 'form_selector', true );
$form_link = get_post_meta( get_the_ID(), 'form_link', true );
$container_width = get_post_meta( get_the_ID(), 'container_width', true );
if($gap == ""){
    $gap = 12;
}
$script = "<script type='text/javascript'>document.documentElement.style.setProperty('--mb_title','{$gap}px');</script>";
echo $script;
echo "<script type='text/javascript'>document.body.classList.add('{$font}');</script>";
$row1 = 0;
$row2 = 0;
$row3 = 0;
foreach((array) $entries as $key => $entry){
    if (isset($entry["row_num_features"]) and is_numeric($entry["row_num_features"]) and $row1 == 0)
        $row1 = $entry["row_num_features"];
    if (isset($entry["row_num_comprastion"]) and is_numeric($entry["row_num_comprastion"]) and $row2 == 0 and $entry["template_comprastion"] == "comprastion1")
        $row2 = $entry["row_num_comprastion"];
    else if (isset($entry["row_num_comprastion"]) and is_numeric($entry["row_num_comprastion"]) and $row3 == 0 and $entry["template_comprastion"] == "comprastion2")
        $row3 = $entry["row_num_comprastion"];
    if ($row1 != 0 and $row2 != 0 and $row3 != 0)
        break;
}
if ($row1 == 0)
    $row1 = 3;
if ($row2 == 0)
    $row2 = 3;
if ($row3 == 0)
    $row3 = 3;
if (count($_GET) != 0 and in_array('man_name',$_GET) and in_array('cell_num',$_GET) and in_array('email',$_GET)){
    echo "{$_GET['man_name']}<br> С вами скоро свяжутся по номеру телефона {$_GET['cell_num']} или по почте {$_GET['email']}";
    if (array_key_exists("comm",$_GET) and strlen($_GET["comm"]) > 2){
        echo "<br> Ваш комментарий был учтён";
    }
    exit;
}
echo "<script type='text/javascript'>
SetDocProperty('--row_len',{$row1});
SetDocProperty('--row_len_2',{$row2});
SetDocProperty('--row_len_3',{$row3});
SetDocProperty('--footer_color','{$color_footer}');
SetDocProperty('--footer_icon_color','{$color_footer_icon}');
</script>";
if(!isset($container_width)){
    $container_width = "1920px";
}
else{
    $container_width = "{$container_width}px";
}
?>


<section class="page">
    <?php
    echo "<div class='container' style='max-width:{$container_width} !important;'>";
     ?>
        <?php
        echo "<script type='text/javascript'>document.body.style.background = '$col';</script>";
        
        function isset_checker($id, $default, $entry){
            if( isset($entry[$id])){
            return $entry[$id];
            };
            return $default;
        }
        
        function getStyle($style){
            if(isset($style) and $style != false)
                return $style;
            else
                return array(0 => "bold");
        }
        
        function getId($entry){
            if (isset($entry["block_id"]) and $entry["block_id"] != "")
                return "id='{$entry['block_id']}'";
            return "";
        }
        
        function echoFeatures($entry){
            $id = getId($entry);
            if(isset($entry["features_size"]) and intval($entry["features_size"])){
                $size = intval($entry["features_size"]);
            }
            else{
                $size = 12;
            }
            $sizeh = $size*1.5;
            $icon = "<div class='feature__icon'>
                <svg width='60' height='60' viewBox='0 0 72 73' fill='none' xmlns='http://www.w3.org/2000/svg'>
                    <path d='M2 43.7706C25.9232 74.3228 27.3616 96.2821 69 2' stroke='#4D54F3'
                        stroke-width='5' />
                </svg>
            </div>";
            switch ( $entry["template_features"] ){
                case "feature1":
                    $head = splitByNewChapter(nl2br($entry["feature_header"]));
                    $head = fillUpTo($head,2," ");
                    echo "<div class='layout feature1 section_gap' {$id}>
                    <div class='feature1__header'>
                        <h2 class='feature__title feature1__title' style='font-size: {$sizeh}px;'>{$head[0]}</h2>
                        <h3 class='feature__title--h3' style='font-size: {$size}px;'>{$head[1]}</h3>
                    </div>";
                    echo '<ul class="feature1__list list--reset">';
                    foreach ($entry["feature_list"] as $val){
                        $text = splitByNewChapter(nl2br($val));
                        $text = fillUpTo($text,2," ");
                        echo '<li class="feature__list__item feature1__list__item">';
                        echo $icon;
                        echo "<div class='feature__list__text'>
                    <h4 class='feature1__list__text__title'style='font-size: {$sizeh}px;'>{$text[0]}</h4>
                    <p class='list__text__par'style='font-size: {$size}px;'>{$text[1]}</p>
                    </div></li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                    break;

                case "feature2":
                    $head = $entry["feature_header"];
                    echo "<div class='layout feature2 section_gap' {$id}>
                        <h2 class='feature__title feature2__title' style='font-size: {$sizeh}px;'>{$head}</h2>
                        <div class='feature2__content'>
                        <ul class='feature2__list list--reset'>";
                    foreach ($entry["feature_list"] as $val){
                        $text = splitByNewChapter(nl2br($val));
                        $text = fillUpTo($text,2," ");
                        echo "<li class='feature__list__item feature2__list__item'>";
                        echo $icon;
                        echo "<div class='feature__list__text'>
                        <h4 class='feature2__list__text__title' style='font-size: {$sizeh}px;'>{$text[0]}</h4>
                        <p class='list__text__par' style='font-size: {$size}px;'>{$text[1]}</p>
                        </div></li>";
                    }
                    echo "</ul>";
                    echo "<img class='feature2__img' src='{$entry["pic_features"]}' alt=''>";
                    echo "</div></div>";
                    break;

                case "feature3":
                    $head = splitByNewChapter(nl2br($entry["feature_header"]));
                    $head = fillUpTo($head,2," ");
                    $count = 1;
                    echo "<div class='layout feature3 section_gap' {$id}>
                    <div class='feature3__header'>
                    <h2 class='feature__title feature3__title' style='font-size: {$sizeh}px;'>{$head[0]}</h2>
                    <h3 class='feature__title--h3' style='font-size: {$size}px;'>{$head[1]}</h3>
                    </div>
                    <ul class='feature3__list list--reset'>";
                    foreach ($entry["feature_list"] as $val){
                        $text = splitByNewChapter(nl2br($val));
                        $text = fillUpTo($text,2," ");
                        echo "<li class='feature__list__item feature3__list__item'>
                        <div class='feature3__list__wrapper'>
                        <div class='feature3__circle'>{$count}</div>
                        <div class='feature__list__text'><h4 class='feature2__list__text__title' style='font-size: {$sizeh}px;'>{$text[0]}</h4>
                        <p class='list__text__par style='font-size: {$size}px;''>{$text[1]}</p></div></div></li>";
                        $count += 1;
                    }
                    echo "</ul></div>";
                    break;
            };
        }
        
        function echoComprastion($entry){
            $id = getId($entry);
            if(isset($entry["comprastion_size"]) and intval($entry["comprastion_size"])){
                $size = intval($entry["comprastion_size"]);
            }
            else{
                $size = 12;
            }
            $sizeh = $size*1.5;
            switch ( $entry["template_comprastion"] ){
                case 'comprastion1':
                    $range = min(count($entry["comprastion_list"]), count($entry['pic_comprastion']));
                    $entry['pic_comprastion'] = array_values($entry['pic_comprastion']);
                    echo "<div class='layout comprastion1 section_gap' {$id}>
                    <ul class='comprastion1__list list--reset'>";
                    for($i = 0; $i < $range; $i++){
                        echo "<li class='comprastion1__list__item'>
                        <img src={$entry['pic_comprastion'][$i]} alt='' class='comprastion1__list__item__img'>
                        <p class='comprastion1__list__item__text' style='font-size: {$sizeh}px;'>{$entry["comprastion_list"][$i]}</p></li>";
                    }
                    echo "</ul></div>";
                    break;
                case 'comprastion2':
                    echo "<div class='layout comprastion2 section_gap' {$id}>
                    <h2 class='comprastion2__title' style='font-size: {$sizeh}px;'>{$entry["comprastion_header"]}</h2>
                    <ul class='comprastion2__list list--reset'>";
                    foreach ($entry["comprastion_list"] as $val){
                        $text = splitByNewChapter(nl2br($val));
                        $text = fillUpTo($text,2," ");
                        echo "<li class='comprastion2__list__item'>
                        <div class='comprastion2__list__item__top-text' style='font-size: {$sizeh}px;'>{$text[0]}</div>
                        <div class='comprastion2__list__item__bottom-text' style='font-size: {$size}px;'>{$text[1]}</div>
                        </li>";
                    }
                    echo "</ul></div>";
                default:
                    break;
            }
        }
        
        function echoIcon($icon, $link, $path){
            echo "<li class='footer__black__list__icon'>
                    <a href='{$link}'>
                        <svg>
                            <use xlink:href='{$path}#{$icon}'></use>
                        </svg>
                    </a>
                </li>";
        }
        
        foreach ( (array) $entries as $key => $entry ) {
        $style_arr = '';
        if ( array_key_exists('style_radio',$entry) )
            $style = implode(" ",getStyle($entry['style_radio']));
        $mirror = isset_checker("pic_mirror", "", $entry);
        $align = isset_checker("text_block_align_selector", "", $entry);
        $color = isset_checker('colorpicker', "#000000", $entry);
        $size = isset_checker('text_block_size', '12', $entry);
        $border_width = isset_checker('pic_border_width', '', $entry);
        $border_radius = isset_checker('pic_radius', '', $entry);
        $border = "style='border: {$border_width}px solid {$color};border-radius: {$border_radius}%;'";
        $id = getId($entry);
        switch($entry["template_selector"]){
            case "text_block":
                if (isset($entry['need_split_text']) and $entry['need_split_text']){
                    $text = splitByNewChapter(nl2br($entry['text_block_textbox']));
                    $sizeh = $size*1.5;
                    echo "<h2 style='
                    color:$color;
                    font-size:{$sizeh}px;
                    margin-bottom: 20px;
                    '>{$text[0]}</h2>";
                    echo "<p class='$style $align section_gap' {$id} style='
                    color:$color;
                    font-size:{$size}px;
                    '>{$text[1]}</p>";
                }
                else{
                    $text = nl2br($entry['text_block_textbox']);
                    echo "<p class='$style $align section_gap' {$id} style='
                    color:$color;
                    font-size:{$size}px;
                    '>$text</p>";
                }
                break;
                
            case "pic":
                echo "<img class='{$mirror} center_block section_gap' {$id} src={$entry['pic_imgbox']} $border />";
                break;
                
            case "imgtext":
                $text = $entry['text_block_textbox'];
                $temp = $entry['imgtext_selector'];
                $temp2 = "";
                $temp1 = "";
                switch($temp){
                    case "left":
                        $temp2 = "left";
                        break;
                    default:
                        $temp1 = "left";
                        break;
                }
                $par = "<p class='$style $align $temp1 descr' style='
                color:$color;
                font-size:{$size}px;
                '>$text</p>";

                $img = "<img class='img {$mirror} $temp2' src={$entry['pic_imgbox']} $border /img>";
                switch($temp){
                    case "left":
                        echo "<div class='template2 section_gap' {$id}>
                        {$img} {$par}  </div>";
                        break;
                    default:
                        echo "<div class='template1 section_gap' {$id}>
                        {$par} {$img} </div>";
                        break;
                }
                break;
            case "video":
                $src = $entry['vid_file'];
                $ps = $entry['vid_cover'];
                $st = implode(" ", $entry['vid_style']);
                echo "<video class='center_block section_gap' {$id} poster='$ps' controls='controls' $st>
                        <source src='$src'>
                      </video>";
                break;
            case "video_emb":
                echo wp_oembed_get($entry["embed"]);
                break;
            case "features":
                echoFeatures($entry);
                break;
            case "comprastion":
                echoComprastion($entry);
                break;
        }
        }
        if(get_post_meta( get_the_ID(), "need_form", 1)){
        switch($form_type){
            case "form1":
                echo "<div class='layout form1'>
                <form class='form--one' action='{$form_link}' method='get'>
                        <input class='form-one__input input' name='email' id='email' type='email' placeholder='Email'>
                        <input class='form-one__input input' name='man_name' id='name' type='text' placeholder='ФИО'>
                        <input class='form-one__input input' name='cell_num' id='cell_num' type='tel' placeholder='Телефон'>
                        <button class='form-one__input submit--button'>Отправить</button>
                    </form>
                </div>";
                break;
            case "form2":
                echo "<div class='layout form2'>
                        <form class='form--two' action='{$form_link}' method='get'>
                                <ul class='form--two__list list--reset'>
                                    <li class='form--two__list__item'>
                                        <h3 class='form__two__list__title title--reset'>Email</h3>
                                        <input type='email' name='email' id='email' class='input form--two__input' placeholder='Email'>
                                    </li>
                                    <li class='form--two__list__item'>
                                        <h3 class='form__two__list__title title--reset'>Полное имя</h3>
                                        <input type='text' name='man_name' id='name' class='input form--two__input' placeholder='ФИО'>
                                    </li>
                                    <li class='form--two__list__item'>
                                        <h3 class='form__two__list__title title--reset'>Телефон</h3>
                                        <input type='tel' name='cell_num' id='cell_num' class='input form--two__input' placeholder='Телефон'>
                                    </li>
                                    <li class='form--two__list__item'>
                                        <h3 class='form__two__list__title title--reset'>Комментарий</h3>
                                        <textarea class='input form--two__input' name='comm' id='comm' cols='30' rows='10'></textarea>
                                    </li>
                                </ul>
                                <button class='form--two__button submit--button'>Отправить</button>
                            </form>
                        </div>";
                break;
            default:
                break;
        }};
        ?>
    </div>
    <?php
    if (get_post_meta( get_the_ID(), "need_footer", 1)){
    $link1 = get_post_meta( get_the_ID(), "link1", true);
    $link2 = get_post_meta( get_the_ID(), "link2", true);
    $link3 = get_post_meta( get_the_ID(), "link3", true);
    $link4 = get_post_meta( get_the_ID(), "link4", true);
    $link5 = get_post_meta( get_the_ID(), "link5", true);
    $link6 = get_post_meta( get_the_ID(), "link6", true);
    $link7 = get_post_meta( get_the_ID(), "link7", true);
    $icons_svg_path = "/wp-sitegen/wp-content/themes/basic-theme/icon.svg";
    echo "<footer>
        <div class='footer__black'>
            <ul class='footer__black__list list--reset'>";
    if (isset($link1) and $link1 != "")
        echoIcon("vk-icon",$link1,$icons_svg_path);
    if (isset($link2) and $link2 != "")
        echoIcon("facebook-icon",$link2,$icons_svg_path);
    if (isset($link3) and $link3 != "")
        echoIcon("youtube-icon",$link3,$icons_svg_path);
    if (isset($link4) and $link4 != "")
        echoIcon("instagram-icon",$link4,$icons_svg_path);
    if (isset($link5) and $link5 != "")
        echoIcon("telegram-icon",$link5,$icons_svg_path);
    if (isset($link6) and $link6 != "")
        echoIcon("twitter-icon",$link6,$icons_svg_path);
    if (isset($link7) and $link7 != "")
        echoIcon("class-icon",$link7,$icons_svg_path);
    echo"</ul>
        </div>
    </footer>";};
    ?>
</section>

<?php get_footer();?>