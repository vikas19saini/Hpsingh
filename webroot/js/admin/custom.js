
/* start custom Accordion */
$('.toggle').click(function (e) {
    e.preventDefault();
    var $this = $(this);
    if ($this.next().hasClass('show')) {
        $this.next().removeClass('show');
        $this.next().slideUp(350);

    } else {
        $this.parent().parent().find('li .inner').removeClass('show');
        $this.parent().parent().find('li .inner').slideUp(350);
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);

    }
});

/*Accordion  menu active  */
$(document).ready(function () {
    $(".left_menu>ul>li>a").click(function () {
        $(this).toggleClass("active");
        $(this).parent().siblings().children().removeClass("active")
    });
    $(".collapse").click(function () {
        $(".left_menu").addClass("active");
        $(".left_menu.left_menu2").addClass("active");
        $(".right_content").addClass("active");
        document.cookie = "menu=collapse";
    });
    $(".collapse2").click(function () {
        $(".left_menu").removeClass("active");
        $(".left_menu.left_menu2").removeClass("active");
        $(".right_content").removeClass("active");
        document.cookie = "menu=expended";
    });
});