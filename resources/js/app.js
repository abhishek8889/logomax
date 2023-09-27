import './bootstrap';

window.Echo.channel('chat')
    .listen('.message',(e)=>{
        console.log(e);
    });