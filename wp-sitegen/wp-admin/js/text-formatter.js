let temp = document.getElementsByClassName("cmb2_textarea");
const color_Id = 'colorpicker';
const textarea = 'text_block_textbox';
const checkboxStyle = "style_radio";
const fontsize = "text_block_size";
const allign = "text_block_align_selector";
const selector = "template_selector";
const text_blocks = ["text_block","imgtext"];
const pic_blocks = ["imgtext","pic"];
const pic_imgbox = "pic_imgbox-status";
const pic_rad = "pic_radius";
const pic_b_w = "pic_border_width";
const feature_lst = "feature_list_repeat";
const comprastion_lst = "comprastion_list_repeat";
const template_features = "template_features";
const template_comprastion = "template_comprastion";
const preview_dir = "/wp-sitegen/wp-admin/images/preview/";
const feature_img = [preview_dir+'features_1.png',preview_dir+'features_2.png',preview_dir+'features_3.png']
const comprastion_img = [preview_dir+"comprastion_1.png",preview_dir+"comprastion_2.png"]
const form_pics = [preview_dir+"form_1.png",preview_dir+"form_2.png"]
const header_links = "header_links_repeat";

setInterval(edit_forms,1000);
setTimeout(form_pictures,1000);

function s (e){
    let mass = getById(header_links);
    let arr = mass.getElementsByClassName("cmb2_textarea");
    for (let i = 0;i<arr.length;i++){
        arr[i].rows = "2"
    }
}
setInterval(s,1000);
const group_name = "test_group";
const form_name = `cmb-group-${group_name}`;

function form_pictures(){
    for(var i = 0;i<form_pics.length;i++)
    {
    temp_img = document.createElement("img")
    temp_img.src = form_pics[i]
    document.getElementById("form_selector"+(i+1)).parentElement.appendChild(temp_img)
    }
}

// edit_forms("cmb-group-test_group");
function edit_forms (){
    let counter = 0;
    let form = getById(form_name+`-${counter}`)
    if (!form) return;
    let font = getById("font_selector").value;
    while (!!form){
        let groupName = form.id.replace("cmb-group-","").replace("-","_");
        let sel = getById(makeAnId(groupName,selector));
        let sel_val = sel.options[sel.options.selectedIndex].value;
        if (text_blocks.includes(sel_val)){
            let area = makeAnId(groupName,textarea)
            init_setColor(makeAnId(groupName,color_Id), area, groupName);
            init_setStyle(makeAnId(groupName,checkboxStyle), area);
            init_setFontSize(makeAnId(groupName,fontsize), area);
            init_setAllign(makeAnId(groupName,allign), area);
            getById(makeAnId(groupName,textarea)).classList.add(font.toString())
        }
        if (pic_blocks.includes(sel_val)){
            if(!!getById(makeAnId(groupName,pic_imgbox)).firstChild){
            let img = getById(makeAnId(groupName,pic_imgbox)).firstChild.firstChild;
            if(!!img){
                img.style.borderRadius = getById(makeAnId(groupName,pic_rad)).value+"%";
                img.style.borderWidth = `${getById(makeAnId(groupName,pic_b_w)).value}px`;
                img.classList.remove("horizontal");
                img.classList.remove("vertical");
                if(getById(makeAnId(groupName,"pic_mirror")).value)
                    img.classList.add(getById(makeAnId(groupName,"pic_mirror")).value);
            }
            getById(makeAnId(groupName,pic_rad)).onchange = function (e){
                if(!!img){
                    img.style.borderRadius = `${e.target.value}%`;
                }
            } 
            getById(makeAnId(groupName,pic_b_w)).onchange = function (e){
                if(!!img){
                    img.style.borderWidth = `${e.target.value}px`;
                }
            }
            getById(makeAnId(groupName,"pic_mirror")).onchange = function (e){
                if(!!img){
                    img.classList.remove("horizontal");
                    img.classList.remove("vertical");
                    if(e.target.value)
                        img.classList.add(e.target.value);
                }
            }
        }
        }
        if (["features","comprastion"].includes(sel_val)){
            switch (sel_val){
                case "features":
                    init_addPicures(groupName, template_features, feature_img);
                    break;
                case "comprastion":
                    init_addPicures(groupName, template_comprastion, comprastion_img)
                    break;
            }
        }
        sel.onchange = function (e){

            let val = e.target.selectedOptions[0].value;
            let features_style = getById(makeAnId(groupName,feature_lst)).parentElement.parentElement.style;
            let com_style = getById(makeAnId(groupName,comprastion_lst)).parentElement.parentElement.style;
            switch (val){
                case "features":
                    features_style.removeProperty("display");
                    com_style.display = "none";
                    break;

                case "comprastion":
                    features_style.display = "none";
                    com_style.removeProperty("display");
                    break;
                default:
                    com_style.display = "none";
                    features_style.display = "none";
                    break;
            }
        }
        if (sel_val != "features"){
            let div = getById(makeAnId(groupName,feature_lst)).parentElement.parentElement;
            div.style.display = "none";
        }
        if (sel_val != "comprastion"){
            let div = getById(makeAnId(groupName,comprastion_lst)).parentElement.parentElement;
            div.style.display = "none";
        }
        counter += 1
        form = getById(form_name+`-${counter}`)
    }
    let s = document.getElementsByClassName("cmb-add-group-row button-secondary");
    // for (let i = 0; i < s.length; i++) {
    //     if (s[i].getAttribute("data-selector") === group_name+"_repeat")
    //         s[i].onclick = function () { setTimeout(edit_forms,100);};
    // }
}

function makeAnId(a, b){
    return a+"_"+b;
}

function init_addPicures(gname, dest, img){
    for(var i = 0;i<img.length;i++){
        var id = makeAnId(gname,dest+(i+1))+"pic"
        if(!!getById(id))
            return;
        var temp_img = document.createElement("img")
        temp_img.src = img[i]
        temp_img.alt = "Шаблон "+i
        temp_img.id = id
        var el = getById(makeAnId(gname,dest+(i+1)))
        el.parentElement.appendChild(temp_img)
    }
}

function init_setColor(colorid, areaId, gname) {
    let box = getById(colorid);
    let col = box.value;
    let container = box.parentElement.parentElement.parentElement;
    let button = container.firstChild;
    getById(areaId).style.color = col;
    if(!!getById(makeAnId(gname,pic_imgbox)) && !!getById(makeAnId(gname,pic_imgbox)).firstChild){
    let img = getById(makeAnId(gname,pic_imgbox)).firstChild.firstChild;
    container.onmouseup = () =>
    {
        getById(areaId).style.color = button.style.backgroundColor;
        if(!!img){
            img.style.borderColor = button.style.backgroundColor;
        }
    }
    box.onchange = function (e) {
        getById(areaId).style.color = e.target.value;
        if(!!img){
            img.style.borderColor = e.target.value;
        }
    }
    if(!!img){
        img.style.borderColor = col;
    }}
    else{
    container.onmouseup = () =>
    {
        getById(areaId).style.color = button.style.backgroundColor;
    }
    box.onchange = function (e) {
        getById(areaId).style.color = e.target.value;
    }}
}

function init_setStyle(styleId, areaId){
    let i = 1;
    let el = getById(styleId+i.toString());
    el.parentElement.parentElement.parentElement.getElementsByTagName("p")[0].style.display = "none";
    while (!!el){
        if(el.checked){
            getById(areaId).classList.add(el.value)
        }
        let area = getById(areaId);
        listenerById(el,getById(areaId),'change',(x)=> x.value, (a,b) => a.classList.contains(b) ? a.classList.remove(b) : a.classList.add(b));
        i+=1
        el = getById(styleId+i.toString())
    }
}

function init_setFontSize(fontsizeId, areaId){
    let input = getById(fontsizeId);
    getById(areaId).style.fontSize = `${input.value}px`;
    input.onchange = (e) => getById(areaId).style.fontSize = `${e.target.value}px`;
}

function init_setAllign(allingId, areaId) {
    let select = getById(allingId);
    getById(areaId).classList.add(select.value);
}

function getArrFromName(str){
    return str.split(/\[|\]/g).filter(a => !!a);
}

function getById(id){
    return document.getElementById(id);
}

function listenerById(source, target, type, get, set){
    source.addEventListener(type, function () {
        let temp_val = get(source);
        if (!!temp_val) {
            set(target, temp_val)
        }
    })
}