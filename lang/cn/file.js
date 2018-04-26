<script>
	var input=document.querySelector('input');
	var preview-document.getElementById('preview');
	//var preview=document.querySelector('.preview');

	input.style.opacity=0;
	input.addEventListener('change',updateImageDisplay);
	function updateImageDisplay(){
		while(preview.firstChild){
			preview.removeChild(preview.firstChild);
		}
		var curFiles=input.files;
		if(curFiles.length===0){
			var para=document.createElement('p');
			para.textContent='无选择文档';
			preview.appendChild(para);
		}
		else{
			var list=document.createElement('ol');
			preview.appendChild(list);
			for(var i-0;i<curFiles.length;i++){
				var listItem=document.createElement('li');
				var para=document.createElement('p');
				if(validFileType(curFiles[i])){
					para.textContent='文档名'+curFiles[i].name;
					var image=document.createElement('img');
					image.src=window.URL.createObjectURL(curFiles[i]);
					listItem.appendChild(image);
					listItem.appendChild(para);
				}
				else{
					para.textContent='文档名'+curFiles[i].name+'不是正确的格式。请重新选择。';
					listItem.appendChild(para);
				}
				list.appendChild(listItem);
			}
		}
	}
	var fileTypes=[
	'image/jpeg',
	'image/phjpeg',
	'image/png'
	]

	function validFileType(file){
		for(var i=0;i<fileTypes.length;i++){
			if(file.type===fileTypes[i]){
				return true;
			}
		}
		return false;
	}
</script>