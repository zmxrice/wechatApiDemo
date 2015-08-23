// JavaScript Document
$(document).ready(function(){
	var arr=['A','B','C','D','E','F','G','H','I'];
	var corner=['A','C','G','I'];
	var success=[['A','B','C'],['D','E','F'],['G','H','I'],['A','D','G'],['B','E','H'],['C','F','I'],['A','E','I'],['C','E','G']];
	var san=new Array();
	var yuan=new Array();
	var total=new Array();
	$("td").click(function(){
	if($("#result").is(":hidden")){
		if ($(this).text()==""){
			//玩家点击后显示实心点
			$(this).text("●");
			//将玩家的步骤存入数组
			san.push($(this).attr("id"));
			total.push($(this).attr("id"));
			for (var i=0;i<arr.length;i++){
				if (arr[i] == $(this).attr("id")){
					//可以下的位置少了一个
					arr=removeElement(i,arr);
				}
			}
			//判断是否四个角的位置
			for (var j=0;j<corner.length;j++){
				if (corner[j] == $(this).attr("id")){
					//可以下的角的位置少了一个
					corner=removeElement(j,corner);
				}
			}

			//判断玩家赢
			decideUserWin(success,san,total);

			if($("#result").is(":hidden")){
				//电脑应该走的位置
				var n;
				var temp;
				//判断中间有没有被填，没有则填上
				if($("#E").text()==""){
					n=getMiddle(arr);
				}
				//判断电脑是否出现两个的情况，如果出现就填上第三个子
				else if(isTwo(yuan,success,total)){
					console.log("A");
					n=getPos(yuan,success,total,arr);
				}
				//判断玩家是否已经出现两个的情况并且要保证没有已经被电脑堵着
				else if(isTwo(san,success,total)){
					console.log("B");
					n=getPos(san,success,total,arr);
					if(isCorner(n,arr,corner)){
						temp=getInCorner(n,arr,corner);
						corner=removeElement(temp,corner);
					}
				}
				//如果边上有两个在对角
			  	else if (is_formed_edge(san)){
			  		console.log("C");
			  		if(corner.length>0){
						temp=Math.floor(Math.random()*corner.length+1)-1;
						n=getCorner(temp,corner,arr);
						while(arr[n] == cannot_choose_based_on_edge(san)){
							temp=Math.floor(Math.random()*corner.length+1)-1;
							n=getCorner(temp,corner,arr);
						}
						corner=removeElement(temp,corner);
					}
					else{
						n=Math.floor(Math.random()*arr.length+1)-1;
					}
				}
				//ANOTHER CASE
				else if (is_formed_edge2(san)){
					console.log("D");
					if(corner.length>0){
						temp=Math.floor(Math.random()*corner.length+1)-1;
						n=getCorner(temp,corner,arr);
						while(arr[n] == cannot_choose_based_on_edge2(san)){
							temp=Math.floor(Math.random()*corner.length+1)-1;
							n=getCorner(temp,corner,arr);
						}
						corner=removeElement(temp,corner);
					}
					else{
						n=Math.floor(Math.random()*arr.length+1)-1;
					}
				}
				//如果玩家已经抢了三个角，则不再抢角
				else if(corner.length < 2){
					console.log("E");
					n=Math.floor(Math.random()*arr.length+1)-1;
					while(isCorner(n,arr,corner)){
						n=Math.floor(Math.random()*arr.length+1)-1;
					}
				}
				else if(diagnal(san)){
					console.log("F");
					n=Math.floor(Math.random()*arr.length+1)-1;
					while(isCorner(n,arr,corner)){
						n=Math.floor(Math.random()*arr.length+1)-1;
					}
				}
				//先填4个角
				else if(corner.length>0){
					console.log("G");
					temp=Math.floor(Math.random()*corner.length+1)-1;
					n=getCorner(temp,corner,arr);
					corner=removeElement(temp,corner);
				}else{
					console.log("H");
					n=Math.floor(Math.random()*arr.length+1)-1;
					if(isCorner(n,arr,corner)){
						temp=getInCorner(n,arr,corner);
						corner=removeElement(temp,corner);
					}
				}

				//前面获取电脑应该下的位置
				$("#"+arr[n]).text("○");
				yuan.push(arr[n]);
				total.push(arr[n]);
				arr=removeElement(n,arr);

				//判断电脑是否赢
				decideRobWin(success,yuan,total);
			}
		}
	}
	});

    $("button").click(function(){
		location.reload();

	});

});
//删除数组中的元素
function removeElement(index,array){
if(array.length==1){
	array.length=0;
}else if(index>=0 && index<array.length){
	for(var i=index; i<array.length; i++){
   		array[i] = array[i+1];
	}
	array.length = array.length-1;
}
return array;
}

function getMiddle(arr){
	for(var i=0;i<arr.length;i++){
		if(arr[i]=="E"){
			return i;
		}
	}
}

function isCorner(n,arr,corner){
	var mybool=false;
	for(var i=0;i<corner.length;i++){
		if(corner[i]==arr[n]){
			mybool=true;
		}
	}
	return mybool;
}
//获得角数组中的位置
function getInCorner(n,arr,corner){
	var n;
	for(var i=0;i<corner.length;i++){
		if(corner[i]==arr[n]){
			n=i;
		}
	}
	return n;
}
//获得四个角在棋盘的位置
function getCorner(temp,corner,arr){
	var n;
	for(var i=0;i<arr.length;i++){
		if(arr[i]==corner[temp]){
			n=i;
		}
	}
	return n;
}

//判断是否有两个棋子在一条线上
function isTwo(san,success,total){
	var mybool=false;
	for(var x=0;x<success.length;x++){
		var stemp=0;
		for(var y=0;y<success[x].length;y++){
			for(var z=0;z<san.length;z++){
				if(success[x][y]==san[z]){
					stemp++;
				}
			}
		}
		if(stemp==2){
			var mytemp=0;
			for(var y=0;y<success[x].length;y++){
				for(var z=0;z<total.length;z++){
					if(success[x][y]==total[z]){
						mytemp++;
					}
				}
			}
			if(mytemp==2){
				mybool=true;
			}
		}
	}
	return mybool;
}

//获取棋子在棋盘中的位置
function getPos(san,success,total,arr){
	var n;
	for(var x=0;x<success.length;x++){
		var stemp=0;
		for(var y=0;y<success[x].length;y++){
			for(var z=0;z<san.length;z++){
				if(success[x][y]==san[z]){
					stemp++;
				}
			}
		}

		if(stemp==2){
			var mytemp=0;
			for(var y=0;y<success[x].length;y++){
				for(var z=0;z<total.length;z++){
					if(success[x][y]==total[z]){
						mytemp++;
					}
				}
			}
			if(mytemp==2){
				for(var z=0;z<san.length;z++){
					for(var y=0;y<success[x].length;y++){
						if(success[x][y]!=san[z]){
						//获取在棋盘中的位置
							for(var a=0;a<arr.length;a++){
								if(arr[a]==success[x][y]){
									n=a;
								}
							}
						}
					}
				}
			}
		}

	}
	return n;
}

function diagnal(san){
	var count = 0;
	for (var i = 0; i < san.length; i++){
		if (san[i] == "A"){
			count++;
		}
		if (san[i] == "I"){
			count++;
		}
	}
	if(count != 2){
		count = 0;
		for (var i = 0; i < san.length; i++){
			if (san[i] == "C"){
				count++;
			}
			if (san[i] == "G"){
				count++;
			}
		}
	}
	if(count == 2){
		return true;
	}else{
		return false;
	}
}

function is_formed_edge(san){
	var count = 0;
	for(var i = 0; i < san.length;i++){
		if(san[i] == "B"){
			count ++;
		}
		if(san[i] == "F"){
			count ++;
		}
		if (count == 2){break;}
	}
	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "F"){
				count ++;
			}
			if(san[i] == "H"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count != 2){
	  count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "D"){
				count ++;
			}
			if(san[i] == "H"){
				count ++;
			}
			if (count == 2){break;}
		}
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "B"){
				count ++;
			}
			if(san[i] == "D"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return true;
	}else{
		return false;
	}
}

function is_formed_edge2(san){
	var count = 0;
	for(var i = 0; i < san.length;i++){
		if(san[i] == "A"){
			count ++;
		}
		if(san[i] == "H"){
			count ++;
		}
		if (count == 2){break;}
	}
	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "A"){
				count ++;
			}
			if(san[i] == "F"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count != 2){
	  count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "C"){
				count ++;
			}
			if(san[i] == "D"){
				count ++;
			}
			if (count == 2){break;}
		}
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "C"){
				count ++;
			}
			if(san[i] == "H"){
				count ++;
			}
			if (count == 2){break;}
		}
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "I"){
				count ++;
			}
			if(san[i] == "B"){
				count ++;
			}
			if (count == 2){break;}
		}
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "I"){
				count ++;
			}
			if(san[i] == "D"){
				count ++;
			}
			if (count == 2){break;}
		}
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "G"){
				count ++;
			}
			if(san[i] == "B"){
				count ++;
			}
			if (count == 2){break;}
		}
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "G"){
				count ++;
			}
			if(san[i] == "F"){
				count ++;
			}
			if (count == 2){break;}
		}
	}

	if (count == 2){
		return true;
	}else{
		return false;
	}
}

function cannot_choose_based_on_edge(san){
	var count = 0;
	for(var i = 0; i < san.length;i++){
		if(san[i] == "B"){
			count ++;
		}
		if(san[i] == "F"){
			count ++;
		}
		if (count == 2){break;}
	}
	if (count == 2){
		return "G";
	}

  count = 0;
	for(var i = 0; i < san.length;i++){
		if(san[i] == "F"){
			count ++;
		}
		if(san[i] == "H"){
			count ++;
		}
		if (count == 2){break;}
	}
	if (count == 2){
		return "A";
	}

  count = 0;
	for(var i = 0; i < san.length;i++){
		if(san[i] == "D"){
			count ++;
		}
		if(san[i] == "H"){
			count ++;
		}
		if (count == 2){break;}
	}
	if (count == 2){
		return "C";
	}

	count = 0;
	for(var i = 0; i < san.length;i++){
		if(san[i] == "B"){
			count ++;
		}
		if(san[i] == "D"){
			count ++;
		}
		if (count == 2){break;}
	}
	if (count == 2){
		return "I";
	}

}

function cannot_choose_based_on_edge2(san){
	var count = 0;
	for(var i = 0; i < san.length;i++){
		if(san[i] == "A"){
			count ++;
		}
		if(san[i] == "H"){
			count ++;
		}
		if (count == 2){break;}
	}
	if (count == 2){
		return "C";
	}
	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "A"){
				count ++;
			}
			if(san[i] == "F"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return "G";
	}
	if (count != 2){
	  count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "C"){
				count ++;
			}
			if(san[i] == "D"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return "I";
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "C"){
				count ++;
			}
			if(san[i] == "H"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return "A";
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "I"){
				count ++;
			}
			if(san[i] == "B"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return "G";
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "I"){
				count ++;
			}
			if(san[i] == "D"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return "C";
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "G"){
				count ++;
			}
			if(san[i] == "B"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return "I";
	}

	if (count != 2){
		count = 0;
		for(var i = 0; i < san.length;i++){
			if(san[i] == "G"){
				count ++;
			}
			if(san[i] == "F"){
				count ++;
			}
			if (count == 2){break;}
		}
	}
	if (count == 2){
		return "A";
	}
}

//判断玩家胜
function decideUserWin(success,san,total){
	if(total.length>=9 && $("#result").is(":hidden")){
		$("#result").text("平局!");
		$("#result").show();
	}else{
			for(var i=0;i<success.length;i++){
				var stemp=0;
				for(var j=0;j<success[i].length;j++){
					for(var m=0;m<san.length;m++){
						if(success[i][j]==san[m]){
							stemp++;
						}
					}
				}

				if(stemp==3){
					$("#result").text("恭喜，你赢了!");
					$("#result").show();
				}

			}
	}
}

//判断电脑胜
function decideRobWin(success,yuan,total){
	if(total.length>=9 && $("#result").is(":hidden")){
		$("#result").text("平局!");
		$("#result").show();
	}else{
			for(var i=0;i<success.length;i++){
				var ytemp=0;
				for(var j=0;j<success[i].length;j++){
					for(var n=0;n<yuan.length;n++){
						if(success[i][j]==yuan[n]){
							ytemp++;
						}
					}
				}

				if(ytemp==3){
					$("#result").text("哈哈，你输了!");
					$("#result").show();
				}

			}
	}
}
