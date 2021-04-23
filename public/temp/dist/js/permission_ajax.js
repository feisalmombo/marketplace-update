$(document).ready(function(){
    $('#user').change(function() {
        url="entrust";
        user=document.getElementById('user').value;
        // console.log(user);
       $.get(url,{user:user},function(data,status){
        jsonData=JSON.parse(data);
            // console.log(jsonData[1][1].slug);
           var html1="";
           var x=[];
           html1+="<label>Privilege</label></br>"
            if (jsonData.length >0) {
            // console.log(jsonData.permissions.length);
                // console.log('hapa');


                    for (var i = 0; i < jsonData[0].permissions.length; i++) {
                        x.push(jsonData[0].permissions[i].slug)
                            html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' checked value='" + jsonData[0].permissions[i].id + "'>"  +"<label class='col-sm-3'>"+jsonData[0].permissions[i].slug +"</label> ";
                    }
            // console.log(x)
            for (var i = 0; i < jsonData[1].length; i++) {
                // console.log(x.indexOf(jsonData[1][i].slug));
                 if(x.indexOf(jsonData[1][i].slug)==-1){
                    // console.log(jsonData[1][i].slug)
                    html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' value='" + jsonData[1][i].id + "'>" +"<label class='col-sm-3'>"+jsonData[1][i].slug +"</label> ";

                 }
            }

                    // console.log("<option value='" + jsonData[i].areas_type_id + "'>" + jsonData[i].name + "</option>");
                }
             else {
                html1 += "<option>-Empty-</option>";
            }
            // console.log(html1)
            $('#permission').html(html1);
       });
    });

    //ENTRUST PERMISSION TO ROLE JQUERY

    $('#role').change(function() {
        url="entrustRole";
        role=document.getElementById('role').value;
        // console.log(role);
       $.get(url,{role:role},function(data,status){
        jsonData=JSON.parse(data);
            // console.log(jsonData[1][1].slug);
           var html1="";
           var x=[];
           html1+="<label>Privilege</label></br>"
            if (jsonData.length >0) {
            // console.log(jsonData.permissions.length);
                // console.log('hapa');


                    for (var i = 0; i < jsonData[0].permissions.length; i++) {
                        x.push(jsonData[0].permissions[i].slug)

                            html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' checked value='" + jsonData[0].permissions[i].id + "'>" +"<label class='col-sm-3'>"+jsonData[0].permissions[i].slug +"</label> ";
                    }
            // console.log(x)
            for (var i = 0; i < jsonData[1].length; i++) {
                // console.log(x.indexOf(jsonData[1][i].slug));
                 if(x.indexOf(jsonData[1][i].slug)==-1){
                    // console.log(jsonData[1][i].slug)
                    html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='permission[]' value='" + jsonData[1][i].id + "'>" +"<label class='col-sm-3'>"+jsonData[1][i].slug +"</label>";

                 }
            }

                    // console.log("<option value='" + jsonData[i].areas_type_id + "'>" + jsonData[i].name + "</option>");
                }
             else {
                html1 += "<option>-Empty-</option>";
            }
            // console.log(html1)
            $('#permission').html(html1);
       });
    });


    //ENTRUSTING ROLE TO USER QUERY

    $('#user').change(function() {
        url="entrust";
        user=document.getElementById('user').value;
        // console.log(user);
       $.get(url,{user:user},function(data,status){
        jsonData=JSON.parse(data);
            // console.log(jsonData[1][1].slug);
           var html1="";
           var x=[];
           html1+="<label>Privilege</label></br>"
            if (jsonData.length >0) {
            // console.log(jsonData.permissions.length);
                // console.log('hapa');


                    for (var i = 0; i < jsonData[0].roles.length; i++) {
                        x.push(jsonData[0].roles[i].slug)
                            html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='role[]' checked value='" + jsonData[0].roles[i].id + "'>" +"<label class='col-sm-3'>"+jsonData[0].roles[i].slug +"</label>";
                    }
            // console.log(x)
            for (var i = 0; i < jsonData[1].length; i++) {
                // console.log(x.indexOf(jsonData[1][i].slug));
                 if(x.indexOf(jsonData[1][i].slug)==-1){
                    // console.log(jsonData[1][i].slug)
                    html1 += "<input class='checkbox-inline col-sm-1' type='checkbox' name='role[]' value='" + jsonData[1][i].id + "'>" +"<label class='col-sm-3'>"+jsonData[1][i].slug +"</label>";

                 }
            }

                    // console.log("<option value='" + jsonData[i].areas_type_id + "'>" + jsonData[i].name + "</option>");
                }
             else {
                html1 += "<option>-Empty-</option>";
            }
            // console.log(html1)
            $('#role').html(html1);
       });
    });


});
