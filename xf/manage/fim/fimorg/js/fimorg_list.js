var treeStore=null;
Ext.onReady(function(){
//Ext.MessageBox.alert("提示", "Hello World");
Ext.QuickTips.init();
	 var t_bar_find = new Ext.Toolbar({
	                hidden:false,
					dock : 'top',
					items:[{text:"增加",  iconCls:'ext_button_add',   id:'showAdd',handler:showAdd}
					      ,{text:"编辑",  iconCls:'ext_button_edit',  id:'showEdit',handler:showEdit}
					      ,{text:"删除",  iconCls:'ext_button_del',   id:'showDel',handler:showDel}
					      ,{text:"排序",  iconCls:'ext_button_order', id:'showOrder',handler:showOrder}
					    //  ,{text:"列表查询",  iconCls:'ext_button_order', id:'showList',handler:showList}
					    //  ,{text:"调整栏目",iconCls:'ext_button_config',id:'showChangeItems',handler:changeItems}
					     // ,{text:"岗位管理",iconCls:'ext_button_config',id:'showGroup',handler:showGroup}
					     // ,{text:"党员管理",iconCls:'ext_button_config',id:'showUser',handler:showUser}
						  //,{text:"展开",id:'showExpand',handler:expandAll}
						  //,{text:"折叠",id:'showZD',handler:collapseAll}
					      ]
				});	
		
treeStore = new Ext.data.TreeStore({ 
        //model: 'Post',
        proxy: {type: 'ajax',
                reader: 'json',
                 url: "fimorgAction.php?action=tree"
        },
        root: {  
                text: '根节点', 
				title: '菜单根目录', 
                postid: "100",  
                expanded: true,
				checked :true  
        },  
        lazyFill: true})
var columns=[new Ext.grid.RowNumberer({header:'序号',width:30})
            ,{xtype: 'treecolumn', text: '名称',width:400,sortable: true,dataIndex: 'title'}
			,{text:  '编号',width:60, dataIndex: 'id',editor: {allowBlank: false},sortable: true}
			,{text:  '类型',width:150, dataIndex: 'type',editor: {allowBlank: false},sortable: true,renderer:function(val, m, rec){return fnChangeName(val,type_array)}}
			,{text:  '类别',width:150, dataIndex: 'orgkind',editor: {allowBlank: false},sortable: true,renderer:function(val, m, rec){return fnChangeName(val,org_kind_array)}}
		//	,{text:  '岗位',width:80,flex: 1, dataIndex: 'id',editor: {allowBlank: false},sortable: true,renderer:function(val, m, rec){return fnChangeName(val,orgGroupsArray)}}
		    ] 			
var tree = new Ext.tree.TreePanel({  
            region: 'center',  
            //collapsible: true,   //True表示为面板是可收缩的，并自动渲染一个展开/收缩的轮换按钮在头部工具条  
           title: '机构管理',//标题文本  
            width: 200, 
			enableDD:true,//是否支持拖拽效果false 
			lines:true,//节点之间连接的横竖线  
			useArrows:true,//是否在树中使用Vista样式箭头，默认为false。 
            border : true,//表框  
            autoScroll: true,//自动滚动条  
            animate : true,//动画效果  
			//singleExpand : true,//在所有的兄弟节点中只能有一个被展开
            rootVisible: false,//根节点是否可见  
			 loadMask: true,
            split: true, 
			collapseMode:'mini',//在分割线处出现按钮  
			//root : root,
			//tbar:t_bar_find,
            store : treeStore,
            columns: columns, 
	   	    dockedItems :t_bar_find,
            listeners: {
				 "checkchange": checkfn  
            }  
        });  
//-----------------------------------------------------------------------------------------------------------------------
var url="fimorg_edit.php?parentid=&m="+m;
var south={region:'east',
                    width: 600,
                    minSize: 100,
                    maxSize: 200,
                    collapsible: true,
                     html:"<iframe name=\"contentFrame\"  src=\""+url+"\" width='100%' height='100%' scrolling=yes frameborder='0'></iframe>",
                    margins:'0 0 0 1'
                }	
   var viewport=new Ext.Viewport({
           enableTabScroll:false,
           layout:"border",
           items:[tree,south]
   });
   //-----------------------------------------------------------------------------------------------------------------------


 //-----------------------------------------------------------------------------------------------------------------------
 function checkfn(node, state){
			 var check= tree.getChecked();
			 Ext.each(check ,function(rec){
				 rec.set('checked', false);  
			 })
			 node.set('checked', true);  
			return false;
			
		//alert(node.isLeaf());//是否叶子节点
		//alert(node.getDepth());//取得当前节点的深度，根节点的深度为0 
		//alert(node.hasChildNodes())//：是否有子节点 
		//isFirst()//：是否为父节点的第一个子节点。 
       //isLast()：//是否为父节点的最后一个子节点。 
	 // var root=tree.getRootNode();
			 node.checked = state;  
				 if(!node.isLeaf()){  
					   node.eachChild(function(childnode){  
					   childnode.set('checked', state);  
					   checkfn(childnode,state);//递归选择	   
				  })  
			  }
		}
		
    tree.on('itemclick', function(treeview, record, item, index, e, opts) {  
	        var check= tree.getChecked();
			 Ext.each(check ,function(rec){
				 rec.set('checked', false);  
			 })
			 record.set('checked', true);  
			
          // var key=record.get('id');
		  //alert(record.data.leaf);
		  //var key=record.data.id;
         //  alert(key);                           
	})
 function expandAll(){
	  tree.expandAll();//展开所有节点
 }
  function collapseAll(){
	  tree.collapseAll();//关闭所有节点
 }

function showAdd(){
	var keyvalue="";
    var rows = tree.getView().getSelectionModel().getSelection();
    if (typeof (rows[0]) == "undefined") {
         // Ext.Msg.alert("提示", "请选择要操作的行！");
         // return false;
    }else{
    	 keyvalue=rows[0].data.id;
    }
   
    window.contentFrame.location.href="fimorg_edit.php?parentid="+keyvalue+"&m="+m;
		

 }
 function showEdit(){
	    var keyvalue="";
	    var rows = tree.getView().getSelectionModel().getSelection();
	    if (typeof (rows[0]) == "undefined") {
              Ext.Msg.alert("提示", "请选择要操作的行！");
              return false;
        }
	    keyvalue=rows[0].data.id;
	    window.contentFrame.location.href="fimorg_edit.php?keyvalue="+keyvalue+"&m="+m;
 }
 function showOrder(){
	 var keyvalue="";
	    var rows = tree.getView().getSelectionModel().getSelection();
	    if (typeof (rows[0]) == "undefined") {
	         // Ext.Msg.alert("提示", "请选择要操作的行！");
	         // return false;
	    }else{
	    	 keyvalue=rows[0].data.id;
	    }
	    window.contentFrame.location.href="fimorg_order.php?parentid="+keyvalue+"&m="+m;
}
 function showList(){
	 window.location.href="fimorg_gridlist.php?m="+m;
 }
function changeItems(){
	    var keyvalue="";
	    var rows = tree.getView().getSelectionModel().getSelection();
	    if (typeof (rows[0]) == "undefined") {
              Ext.Msg.alert("提示", "请选择要操作的行！");
              return false;
        }
	    keyvalue=rows[0].data.id;
	    window.contentFrame.location.href="fimorg_changeitem.php?keyvalue="+keyvalue+"&m="+m;
	
}
 function showGroup(){
	  var keyvalue="";
	    var rows = tree.getView().getSelectionModel().getSelection();
	    if (typeof (rows[0]) == "undefined") {
            Ext.Msg.alert("提示", "请选择要操作的行！");
            return false;
      }
	    keyvalue=rows[0].data.id;
	    window.contentFrame.location.href="fimgroup_list.php?orgid="+keyvalue+"&m="+m;
 }
 function showUser(){
	 var keyvalue="";
	    var rows = tree.getView().getSelectionModel().getSelection();
	    if (typeof (rows[0]) == "undefined") {
         Ext.Msg.alert("提示", "请选择要操作的行！");
         return false;
   }
	    keyvalue=rows[0].data.id;
	    window.contentFrame.location.href="fim_user_list.php?orgid="+keyvalue+"&m="+m;
 }
 
 function showDel(){
	   var rows = tree.getView().getSelectionModel().getSelection();
                if (typeof (rows[0]) == "undefined") {
                    Ext.Msg.alert("提示", "请选择要操作的行！");
                    return false;
                }
                /*
                if(!rows[0].data.leaf){
                	Ext.Msg.alert("提示", "删除子节点后才能删除该节点！");
                	return false;
                }
                */
                if(!confirm('确定删除吗?\n\n连同子分类一起删除且删除后不能恢复！')) return 0;
                keyvalue=rows[0].data.id;
                var params={keyvalue:keyvalue}
        		var url="fimorgAction.php?action=del&m="+m;
                Ext.Ajax.request( {
                	  url : url,
                	  method : 'post',
                	  params : params,
                	  success : function(response, options) {
	                	   var data = Ext.util.JSON.decode(response.responseText);
	                	   var success=data.success;
						   if(success==0){
							   alert("操作失败!");
						   }else if(success==1){  
							    alert("操作成功!");
							    treeStore.reload();
						   }else if(success==2){
						   }else if(success==3){
						   };
                	  },
                	  failure : function() {
                	  }
                	 });

  return false;	 
  var check= tree.getChecked();
	 if(check.length==0){
		 alert("请选择要删除的记录");
		 return false;
	 }
	var keylist="";

	 Ext.each(check ,function(rec){
		 if(keylist!="")keylist+=",";
		    keylist+=rec.get('id');
			//var ischecked=rec.get('checked');
			//var position=rec.get('position');
		})
 }
});     
function fnChangeName(value,jsArray){
    var result="";
      for(var i=0;i<jsArray.length;i++){
	       if((""+value)==(jsArray[i][0]+"")){
		       result=jsArray[i][1];
		       break;
	       }
      }
      return result;
}