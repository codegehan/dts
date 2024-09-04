<style>
body{
    margin: 0px;
    font-family: 'Poppins', sans-serif;
}
#context-menu{
    position: fixed;
    z-index: 10000;
    width: 150px;
    background: #00040d;
    transform: scale(0);
    transform-origin: top left;
}
#context-menu.active{
    transform:scale(1);
    transition: transform 100ms ease-in-out;
}
#context-menu .item-context-menu{
    padding: 4px 10px;
    font-size: 15px;
    color: #eee;
}
#context-menu .item-context-menu:hover{
    background: #555;
    color: #00040d;
    cursor: pointer;
}
#context-menu .item-context-menu i{
    display: inline-block;
    margin-right: 5px;
}
</style>