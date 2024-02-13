import './bootstrap';
console.log('special file call')
window.Echo.channel('specialdDsignerNotification')
    .listen('.notifications',(e)=>{
        let page_id = $("#page_id").val();
        if(page_id == e.eventData.designer_id){
            $("span.icon-active").show();
                $("#host-notification").append(`<div class="nk-notification-item dropdown-inner"><div class="nk-notification-icon"><em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em></div><div class="nk-notification-content"><div class="nk-notification-text"> ${e.eventData.message} <span> <a href="${e.eventData.read_url}"> see </a></span></div><div class="nk-notification-time">just now</div></div></div>`);
        }
    });
let userid = $('#page_id').val();
let active_user = $('#active_user').val();
let base_url = $('#base_url').val();
window.Echo.channel('message'+userid)
        .listen('.messages',(e)=>{
           let files = e.eventData.files;
            if(e.eventData.message != null){
                let message_html = '<div class="chat-bubble"><div class="chat-msg">'+e.eventData.message+'</div></div>';
            }else{
                let message_html = '';
            }
            let files_html = [];
            if(files.length != 0){
                $.each(files ,function(key,value){
                    let file_html = `<div class="file-box d-flex justify-content-between" file-name ="${value}">
                    <button type="button" image-name="${value}" class="download-file">${value} Download</button></div>`;
                    files_html.push(file_html);
                });
            }
           
           let html = '<div class="chat is-you"><div class="chat-content"><div class="chat-bubbles">'+message_html+' '+files_html+'</div><ul class="chat-meta"><li>'+e.eventData.userdata.first_name+' '+e.eventData.userdata.last_name+'</li><li>'+e.eventData.current_time+'</li></ul></div></div>';
            
            $('#chatbox'+e.eventData.sender_id).append(html);
            if(active_user == e.eventData.sender_id){
                $("#chatbox"+recieverid).scrollTop(1000);
                $.ajax({
                    method:'post',
                    url: base_url+'/special-designer/seenMessage',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{ sender_id:e.eventData.sender_id,reciever_id:e.eventData.reciever_id },
                    success:function(response){
                        // console.log(response);
                    }
                }); 
            }else{
                let messagescount = parseInt($('#unseenmessage_count'+e.eventData.sender_id).html());
               $('#unseenmessage_count'+e.eventData.sender_id).html(messagescount+1);
                
                let totalmessages = parseInt($('#counttotal_message'+userid).html());
               $('#counttotal_message'+userid).html(totalmessages+1);
               $("span.icon-active").show();
            }
            $("#userchatlist"+userid).load(location.href + " #userchatlist"+userid);

        });


         
       
