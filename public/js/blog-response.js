$(document).ready(function(){
    $(".create-blog-response").on("click", create_blog_response);
});

function create_blog_response(event){
    event.preventDefault();
    
    let $content = $("input[name=comment_text]").val();
    let $blog_id = $("input[name=blog_id]").val();
    let $_token = $('meta[name="csrf-token"]').attr('content');

    document.getElementById('comment_text').value = '';
    if (!$content){
        return;
    }


    $.ajax({
        url: "/create_blog_response",
        type:"POST",
        data: {
            content: $content,
            blog_id : $blog_id,
            _token: $_token
        },
        success: function(response){
            console.log(response);
            if (response['status'] == "success"){
                append_comment($content, response['name'], response['created_at'], response['id']);
            }
            
        },
        fail: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
            console.log(errorThrown);
        }

    });

}

function append_comment(content, name, time, id){

    let $node = `<li>
        <div class="commentText" id="blog_response_${id}">
            <b class="" style="color: blue">${name}</b>
            <button onclick="delete_blog_response(${id})" class="btn btn-danger btn-sm">delete</button>
            <p class="">${content}</p>
            <span class="date sub-text">${time}</span>
        </div>
    </li>`
    let $comment_area = document.getElementById("comment-area");
    $comment_area.innerHTML = $node + $comment_area.innerHTML;
}


function delete_blog_response($blog_response_id){
    let $_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "/delete_blog_response",
        type:"POST",
        data: {
            blog_response_id : $blog_response_id,
            _token: $_token
        },
        success: function(response){
            console.log(response);
            if (response["status"] == "success"){
                let $blog_response_id = response['blog_response_id'];
                let $search_id = `blog_response_${$blog_response_id}`;
                document.getElementById($search_id).remove();
            }
            
            
        },
        fail: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
            console.log(errorThrown);
        }

    });
}
