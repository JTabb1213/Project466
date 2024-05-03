<html>
    <style>
        .top{
            color: green;
	    text-align: center;
	    }
	.button1{
        align-items: center;
        appearance: none;
        background-image: radial-gradient(100% 100% at 100% 0, #5adaff 0, #5468ff 100%);
        border: 0;
        border-radius: 6px;
        box-shadow: rgba(45, 35, 66, .4) 0 2px 4px,rgba(45, 35, 66, .3) 0 7px 13px -3px,rgba(58, 65, 111, .5) 0 -3px 0 inset;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-flex;
        font-family: "JetBrains Mono",monospace;
        height: 48px;
        justify-content: center;
        line-height: 1;
        list-style: none;
        overflow: hidden;
        padding-left: 16px;
        padding-right: 16px;
        position: relative;
        text-align: left;
        text-decoration: none;
        transition: box-shadow .15s,transform .15s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        white-space: nowrap;
        will-change: box-shadow,transform;
        font-size: 18px;
    }

    .button1:focus {
        box-shadow: #3c4fe0 0 0 0 1.5px inset, rgba(45, 35, 66, .4) 0 2px 4px, rgba(45, 35, 66, .3) 0 7px 13px -3px, #3c4fe0 0 -3px 0 inset;
    }

    .button1:hover {
        box-shadow: rgba(45, 35, 66, .4) 0 4px 8px, rgba(45, 35, 66, .3) 0 7px 13px -3px, #3c4fe0 0 -3px 0 inset;
        transform: translateY(-2px);
    }

    .button1:active {
        box-shadow: #3c4fe0 0 3px 7px inset;
        transform: translateY(2px);
    }

    .button2,
    .button2:after {
        width: 150px;
        height: 76px;
        line-height: 78px;
        font-size: 20px;
        font-family: 'Bebas Neue', sans-serif;
        background: linear-gradient(45deg, transparent 5%, #FF013C 5%);
        border: 0;
        color: #fff;
        letter-spacing: 3px;
        box-shadow: 6px 0px 0px #00E6F6;
        outline: transparent;
        position: relative;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button2:after {
        --slice-0: inset(50% 50% 50% 50%);
        --slice-1: inset(80% -6px 0 0);
        --slice-2: inset(50% -6px 30% 0);
        --slice-3: inset(10% -6px 85% 0);
        --slice-4: inset(40% -6px 43% 0);
        --slice-5: inset(80% -6px 5% 0);
        
        content: 'ALTERNATE TEXT';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 3%, #00E6F6 3%, #00E6F6 5%, #FF013C 5%);
        text-shadow: -3px -3px 0px #F8F005, 3px 3px 0px #00E6F6;
        clip-path: var(--slice-0);
    }

    .button2:hover:after {
        animation: 1s glitch;
        animation-timing-function: steps(2, end);
    }

    @keyframes glitch {
        0% {
            clip-path: var(--slice-1);
            transform: translate(-20px, -10px);
        }
        10% {
            clip-path: var(--slice-3);
            transform: translate(10px, 10px);
        }
        20% {
            clip-path: var(--slice-1);
            transform: translate(-10px, 10px);
        }
        30% {
            clip-path: var(--slice-3);
            transform: translate(0px, 5px);
        }
        40% {
            clip-path: var(--slice-2);
            transform: translate(-5px, 0px);
        }
        50% {
            clip-path: var(--slice-3);
            transform: translate(5px, 0px);
        }
        60% {
            clip-path: var(--slice-4);
            transform: translate(5px, 10px);
        }
        70% {
            clip-path: var(--slice-2);
            transform: translate(-10px, 10px);
        }
        80% {
            clip-path: var(--slice-5);
            transform: translate(20px, -10px);
        }
        90% {
            clip-path: var(--slice-1);
            transform: translate(-10px, 0px);
        }
        100% {
            clip-path: var(--slice-1);
            transform: translate(0);
        }
    }

    @media (min-width: 768px) {
    .button2,
        .button2:after {
            width: 200px;
            height: 86px;
            line-height: 88px;
        }
    }

    .button3 {
        align-items: center;
        background-color: #fff;
        border: 2px solid #000;
        box-sizing: border-box;
        color: #000;
        cursor: pointer;
        display: inline-flex;
        fill: #000;
        font-family: Inter,sans-serif;
        font-size: 16px;
        font-weight: 600;
        height: 48px;
        justify-content: center;
        letter-spacing: -.8px;
        line-height: 24px;
        min-width: 140px;
        outline: 0;
        padding: 0 17px;
        text-align: center;
        text-decoration: none;
        transition: all .3s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button3:focus {
        color: #171e29;
    }

    .button3:hover {
        border-color: #06f;
        color: #06f;
        fill: #06f;
    }

    .button3:active {
        border-color: #06f;
        color: #06f;
        fill: #06f;
    }

    @media (min-width: 768px) {
        .button-59 {
            min-width: 170px;
        }
    }

    .buttonContainer{
        display: flex;
        justify-content: center;
    }

    .right{
        text-align: right;
        margin-right: 20px;
        margin-top: 20px;
    }

    .middle{
        text-align: center;
        margin-right: 20px;
        margin-top: 20px;
        margin-left: 20px;
    }

    .left{
        text-align: left;
        margin-top: 20px;
        margin-left: 20px;
    }
    </style>
    <head>
	<title>Group Project</title>
    </head>
    <body>
	<div class="top">Welcome to karaoke!</div>
        <div class="buttonContainer">
            <div class="left">
                <button class="button1" onclick="window.location.href = 'searchForSong.php';">Search for songs</button>
            </div>
            <div class="middle">
                <button class="button2" onclick="window.location.href = 'queues.php';">Queue</button>
            </div>
            <div class="right">    
                <button class="button3" onclick="window.location.href = 'DJI.php';">DJ interface</button>
            </div>
        </div> 
    </body>
</html>


