var Quiz = {
    
    onClickHeading : function(heading){
        
        
        var data = $(heading).data();
        
        var idbody_q = "#body-" +data.question;
        
        console.debug(idbody_q);
        
        $(idbody_q).slideToggle(500);
        
    },
    
    onClickSolveIt : function (btn){
        
        var data = $(btn).data();
        
        var selector = '.qz-choices-' + data.qid + ' p' ;
        
        for (var i in data.aid) {
            var aid = data.aid[i];
            var rid = 'choice-' + aid;
            $(selector).each(function(){
                var choiceid = $(this).attr('id');
                if(rid == choiceid){
                    $(selector + '[id='+choiceid+']').toggleClass('choice-correct');
                }
                $(selector + '[id='+choiceid+']').unbind('click');
            });
        };
        
        $(btn).attr('disabled','disabled');
    },
    
    onClickChoice :  function(choice){
        $(choice).toggleClass('choice-click');
    },
    
    onReady : function(){
        
        var scope = this;
        
        $('.heading-question').click(function(){
            scope.onClickHeading(this);
        });
        
        $('.btn-solveit').on('click', function(){
            scope.onClickSolveIt(this);
        })
        
        $('.choice').on('click', function(){
            scope.onClickChoice(this);
        })
        
        
    }
    
};

$( document ).ready(function(){
    Quiz.onReady();
}) 