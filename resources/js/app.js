import './bootstrap';

window.Echo.channel('register')
    .listen('.register-notification',(e)=>{
        console.log(e);
        $("span.icon-active").show();
            $("#admin-notification").append(`<div class="nk-notification-item dropdown-inner"><div class="nk-notification-icon"><em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em></div><div class="nk-notification-content"><div class="nk-notification-text"> ${e.eventData.message} <span> <a href="${e.eventData.read_url}"> see </a></span></div><div class="nk-notification-time">just now</div></div></div>`);
    });