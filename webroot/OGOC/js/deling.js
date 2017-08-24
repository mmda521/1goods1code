// JavaScript Document
function glb_searchTextOnfocus(obj) {
	if (obj.value == '请输入口令号码')
		obj.value = '';
	obj.style.color = '#333';
}
function glb_searchTextOnBlur(obj) {
	if (obj.value == '') {
		obj.value = '请输入口令号码';
		obj.style.color = '#fdc24f';
	} else {
		obj.style.color = '#333';
	}
}