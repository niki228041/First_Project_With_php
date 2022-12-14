

//var  onclick={handleDeleteRow('.$id.')}

var deleteLink = document.querySelectorAll(".delete");

for (var i =0;i<deleteLink.length;i++)
{
    deleteLink[i].addEventListener('click',function (event){
        var id = event.target.getAttribute("data-id");
        handleDeleteRow(id);

    })
}

function handleDeleteRow(id)
{
    var bodyFormData = new FormData();
    bodyFormData.append('id',id);

    axios({
        method:"post",
        url:"/deleteProduct.php",
        data:bodyFormData,
        headers:{"Content-Type": "multipart/form-data"},
    }).then(res =>{
            console.log("responceServer",res);
    });

    console.log(id);
}
