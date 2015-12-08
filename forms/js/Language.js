var Language = new Class({

    initialize: function(words) {
        var me = this;
        me.words = words;

    },
    localize: function(string) {
        var me = this;
        if (me.words && (typeof me.words[string]) == 'string') {
            return me.words[string];
        }

        return string;
    },




});
Language.Instance = new Language();