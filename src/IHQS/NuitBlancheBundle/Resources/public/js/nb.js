nb = function() {}

nb.contributeWarGame = function()
{
    var nb_fields = 4;
    var nb_games = 3;

    for(var i = 0; i < nb_fields; i++)
    {
        // player's names
        $('#WarGame_games_0_players_' + i + '_name').change(function()
        {
            var key = $(this).attr('id').charAt(24);
            for(var j = 1; j < nb_games; j++)
            {
                $('#WarGame_games_' + j + '_players_' + key + '_name').val($(this).val());
            }
        });

        // player's races
        $('#wargame_games_0_players_' + i + '_race').change(function()
        {
            var key = $(this).attr('id').charAt(24);
            for(var j = 1; j < nb_games; j++)
            {
                $('#WarGame_games_' + j + '_players_' + key + '_race').val($(this).val());
            }
        });
    }

    // game's dates
    $('#wargame_games_0_date').children('select').change(function()
    {
        var key = $(this).attr('id').substr(15);
        for(var j = 1; j < nb_games; j++)
        {
            $('#WarGame_games_' + j + key).val($(this).val());
        }
    });
}