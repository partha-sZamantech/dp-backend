const bnNumbers = { 0: "০", 1: "১", 2: "২", 3: "৩", 4: "৪", 5: "৫", 6: "৬", 7: "৭", 8: "৮", 9: "৯" };

const jsTime = new Date('25 June, 2022 10:00 AM');
// const jsTime = new Date('8 June, 2022 10:53 PM');

const countdown = () => {
    const newDate = new Date();

    // const class_name = document.getElementsByClassName('inauguration');
    if (newDate && jsTime) {
        // class_name[0].style.display = 'block';
        document.getElementById("countdown").style.display = 'block';
    } else {
        // class_name[0].style.display = 'none';
        document.getElementById("countdown").style.display = 'none';
    }

    const countDate = jsTime.getTime();
    const now = newDate.getTime();
    const gap = countDate - now;

    //The Time Work?
    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;

    //Calculate the time
    const textDay = Math.floor(gap / day);
    const textHour = Math.floor((gap % day) / hour);
    const textMinute = Math.floor((gap % hour) / minute);
    const textSecond = Math.floor((gap % minute) / second);

    let dayArr = textDay.toString().split('');
    let outDay = dayArr.length > 1 ? (bnNumbers[dayArr[0]]+bnNumbers[dayArr[1]]) : bnNumbers[textDay];

    let hrArr = textHour.toString().split('');
    let outHr = hrArr.length > 1 ? (bnNumbers[hrArr[0]]+bnNumbers[hrArr[1]]) : bnNumbers[textHour];

    let minArr = textMinute.toString().split('');
    let outMin = minArr.length > 1 ? (bnNumbers[minArr[0]]+bnNumbers[minArr[1]]) : bnNumbers[textMinute];

    let secArr = textSecond.toString().split('');
    let outSec = secArr.length > 1 ? (bnNumbers[secArr[0]]+bnNumbers[secArr[1]]) : bnNumbers[textSecond];

    if(countDate > now){
        //Show Time in HTML
        document.getElementById("timerDay").innerText = outDay;
        document.getElementById("timerHour").innerText = outHr;
        document.getElementById("timerMinute").innerText = outMin;
        document.getElementById("timerSecond").innerText = outSec;
        // document.getElementById("countdown").innerHTML =
        //     "<span><i class='remaining'>স্বপ্নপূরণের  আর মাত্র</i><br> </span>" +
        //     "<span class='days time'> " + outDay + " <br> <i class='padma-day'>দিন</i> " +
        //     "</span><span class='hours time'>" + outHr + "<br/><i class='padma-day'>ঘণ্টা</i>  " +
        //     "</span><span class='minutes time'>" + outMin + "<br/><i class='padma-day'>মিনিট</i>  " +
        //     "</span><span class='seconds time'>" + outSec + "<br/><i class='padma-day'> সেকেন্ড</i>" + "</span>";
    }
    else{
        document.getElementById("timerDay").innerText = '০';
        document.getElementById("timerHour").innerText = '০';
        document.getElementById("timerMinute").innerText = '০';
        document.getElementById("timerSecond").innerText = '০';
        //Show Time in HTML
        // document.getElementById("countdown").innerHTML =
        //     "<span><i class='remaining'>স্বপ্নপূরণের  আর মাত্র</i><br> </span>" +
        //     "<span class='days time'> 00 <br><i class='padma-day'>দিন</i> " +
        //     "</span><span class='hours time'> 00 <br/><i class='padma-day'>ঘণ্টা</i>  " +
        //     "</span><span class='minutes time'> 00 <br/><i class='padma-day'>মিনিট</i>  " +
        //     "</span><span class='seconds time'> 00 <br/><i class='padma-day'> সেকেন্ড</i>" + "</span>";
    }

};
setInterval(countdown, 1000);