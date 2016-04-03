// this function takes in youtube share url and returns youtube video id
function getYoutubeVideoId(url){
     var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
     if (videoid != null){
        return videoid[1];
     }else{
        console.log("Youtube url is not valid!");
     }
}

// returns current date in this format --> yyyy/mm/dd
function getCurrentDate(){
    var dd = new Date();
    var year = dd.getFullYear();
    var month = dd.getMonth() + 1;
    var day = dd.getDate();
    var full_date = year+'/'+month+'/'+day;
    return full_date;
}

// returns current client time --> hh:mm:ss || hh:mm:ss AM|PM if flag is true
function getCurrentTime(flag = false){
    var postfix = "AM";
    var dd = new Date();
    var hours = dd.getHours();

    if (hours > 12){
        hours = hours - 12;
        postfix = "PM";
    }

    var minutes = dd.getMinutes();
    var seconds = dd.getSeconds();
    var current_time = null;
    if (flag)
        var current_time = hours+':'+minutes+":"+seconds+" "+postfix;
    else
        var current_time = hours+':'+minutes+":"+seconds;
    return current_time;
}

/*
| The time-zone offset is the difference, in minutes, between UTC and local time. Note that this means that the offset is positive | if the local timezone is behind UTC and negative if it is ahead. For example, if your time zone is UTC+10 (Australian Eastern   |  Standard Time), -600 will be returned. Daylight savings time prevents this value from being a constant even for a given locale
*/
function getCurrentTimezoneOffset(){
    var offset = new Date().getTimezoneOffset();
    return offset;
}

// returns first charecter of every word as capital
function capitalize(str) {
    strVal = '';
    str = str.split(' ');
    for (var chr = 0; chr < str.length; chr++) {
        strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
    }
    console.log(strVal);
    return strVal;
}

