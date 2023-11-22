import './bootstrap';
let user_id = $('#userid').val();
let base_url = $('#base_url').val();
let active_user = $('#active_user').val();
window.Echo.channel('message'+user_id)
    .listen('.messages',(e)=>{
        console.log(e);        
       let html = '<div class="sender-d"><div class="s-ryt-img"><span class="str"><img src="'+base_url+'/logomax_pages/img/star.svg"  class="img-fluid" alt="..."></span><span><img src="'+base_url+'/logomax_pages/img/h-dot.svg"  class="img-fluid" alt="..."></span></div><div class="lp-info d-flex"><div class="lp-img"><img src="'+base_url+'/logomax_pages/img/jord.png"  class="img-fluid" alt="..."></div><div class="lp-text"><h6>'+e.eventData.userdata.first_name+' '+e.eventData.userdata.last_name+' <span>10:00 am</span></h6><div class="lv-chat"><p class="b-text">'+e.eventData.message+'</p></div></div></div></div>';``
       
       $('#messagebox'+e.eventData.sender_id).append(html);
       if(active_user == e.eventData.sender_id){
        $('#unseen_count'+e.eventData.sender_id).html(0);

        ///seen message
        $.ajax({
            method:'post',
            url: base_url+'/user-dahsboard/seenMessage',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{ sender_id:e.eventData.sender_id,reciever_id:e.eventData.reciever_id },
            success:function(response){
                console.log(response);
            }
        });

       }else{
        let val = parseInt($('#unseen_count'+e.eventData.sender_id).html());
        let totalmessage = parseInt($('#totalMessages'+user_id).html());
        $('#unseen_count'+e.eventData.sender_id).html(val+1);
        $('#totalMessages'+user_id).html(totalmessage+1);
       }
       $("#chatboxuserslist"+user_id).load(location.href + " #chatboxuserslist"+user_id);
    });