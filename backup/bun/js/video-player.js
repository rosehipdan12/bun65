
function videoDb(prt_parent){
	           var videoChild = prt_parent.children[0]; 
			   console.log(videoChild.isFullscreen);
			if(videoChild.isFullscreen){
					videoChild.exitFullscreen();
				}
				else{
					videoChild.requestFullscreen();
				}
}

