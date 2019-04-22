 $(document).ready(function() {  
        //  加载所有的省份  
        $.ajax({  
            type: "get",  
            url: "http://localhost/dzqc_www/index.php/Region/getArea", // type=1表示查询省份  
            data: {"pid": "440924","depth": "1"},  
            dataType: "json",  
            success: function(data) {  
                $("#provinces").html("<option value='-1'>请选择省份</option>");  
                $.each(data, function(i, item) {  
                    $("#provinces").append("<option value='" + item.id + "'>" + item.title + "</option>");  
                        });  
                    }  
                });  
  
                $("#provinces").change(function() {  
            $.ajax({  
                type: "get",  
                url: "http://localhost/dzqc_www/index.php/Region/getArea", // type =2表示查询市  
                data: {"pid": $(this).val(), "depth": "2"},  
                dataType: "json",  
                success: function(data) {  
                    $("#citys").html("<option value='-1'>请选择市</option>");  
                    $.each(data, function(i, item) {  
                        $("#citys").append("<option value='" + item.id + "'>" + item.title + "</option>");  
                            });  
                        }  
                    });  
                });  
  
                $("#citys").change(function() {  
            $.ajax({  
                type: "get",  
                url: "http://localhost/dzqc_www/index.php/Region/getArea", // type =2表示查询市  
                data: {"pid": $(this).val(), "depth": "3"},  
                dataType: "json",  
                success: function(data) {  
                    $("#countys").html("<option value='-1'>请选择县</option>");  
                    $.each(data, function(i, item) {  
                        $("#countys").append("<option value='" + item.id + "'>" + item.title + "</option>");  
                    });  
                }  
            });  
        });  
}); 