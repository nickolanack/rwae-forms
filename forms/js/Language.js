var Language = new Class({

    initialize: function(words) {
        var me = this;
        me.words = words;

    },
    localize: function(string) {
        var me = this;

        if (me.words && (typeof me.words[string]) == 'string') {
            return '<span class="lang" data-fr="' + me.words[string].replace(/'/g, "&#39;") + '"><span class="en">' + string + '</span></span>';
        }

        return string;
    },




});
Language.Instance = new Language();