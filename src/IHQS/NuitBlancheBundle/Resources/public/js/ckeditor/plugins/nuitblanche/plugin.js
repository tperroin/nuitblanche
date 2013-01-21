CKEDITOR.plugins.add( 'nuitblanche',
{
    init: function( editor )
    {
        this.initAddPlayer(editor);
        this.initAddRaceImage(editor);
        this.initAddClanWar(editor);
    },

    initAddPlayer: function ( editor )
    {
        editor.addCommand('addPlayer', new CKEDITOR.dialogCommand( 'addPlayerDialog' ) );
        CKEDITOR.dialog.add( 'addPlayerDialog', function(editor)
        {
            return {
                title : 'Insert a player',
                minWidth : 400,
                minHeight : 200,

                contents :
                [
                    {
                        id : 'tab1',
                        label : 'Player selection',
                        elements :
                        [
                            {
                                type : 'text',
                                id : 'player',
                                label : 'Pick player user name',
                                validate : CKEDITOR.dialog.validate.notEmpty( "Player field cannot be empty" )
                            }
                        ]
                    }
                ],

                onOk : function()
                {
                    var dialog = this;
                    var player = dialog.getValueOf( 'tab1', 'player' );
                    editor.insertHtml( '\n<span class="player-data">{player:' + player + '}</span>\n' );
                }
            };
        });

        editor.ui.addButton('AddPlayer',
        {
            label: 'Insert a player',
            command: 'addPlayer',
            icon: this.path + 'images/player.png'
        });
    },

    initAddRaceImage: function ( editor )
    {
        editor.addCommand('addRaceImage', new CKEDITOR.dialogCommand( 'addRaceImageDialog' ) );
        CKEDITOR.dialog.add( 'addRaceImageDialog', function(editor)
        {
            return {
                title : 'Insert a race image',
                minWidth : 400,
                minHeight : 200,

                contents :
                [
                    {
                        id : 'sc2',
                        label : 'StarCraft 2',
                        elements :
                        [
                            {
                                type : 'select',
                                id : 'race',
                                label : 'Pick race',
                                items: [
                                    ['random', 'random'],
                                    ['protoss', 'protoss'],
                                    ['terran', 'terran'],
                                    ['zerg', 'zerg']
                                ],
                                validate : CKEDITOR.dialog.validate.notEmpty( "Race field cannot be empty" )
                            }
                        ]
                    }
                ],

                onOk : function()
                {
                    var dialog = this;
                    var race = dialog.getValueOf( 'sc2', 'race' );
                    editor.insertHtml( '\n<img src="/bundles/ihqsnuitblanche/images/ico/' + race + '_icon.png" class="race-icon" />\n' );
                }
            };
        });

        editor.ui.addButton('AddRaceImage',
        {
            label: 'Insert a race icon',
            command: 'addRaceImage',
            icon: '/bundles/ihqsnuitblanche/images/ico/random_icon.png'
        });
    },

    initAddClanWar: function ( editor )
    {
        editor.addCommand('addClanWar', new CKEDITOR.dialogCommand( 'addClanWarDialog' ) );
        CKEDITOR.dialog.add( 'addClanWarDialog', function(editor)
        {
            return {
                title : 'Insert a clan war result',
                minWidth : 400,
                minHeight : 200,

                contents :
                [
                    {
                        id : 'tab1',
                        label : 'Pick clan war id',
                        elements :
                        [
                            {
                                type : 'text',
                                id : 'war',
                                label : 'Clan War',
                                validate : CKEDITOR.dialog.validate.notEmpty( "Clan War field cannot be empty" )
                            }
                        ]
                    }
                ],

                onOk : function()
                {
                    var dialog = this;
                    var war = dialog.getValueOf( 'tab1', 'war' );
                    editor.insertHtml( '\n<div class="news-war">{war:' + war + '}</div>\n' );
                }
            };
        });

        editor.ui.addButton('AddClanWar',
        {
            label: 'Insert a clan war result',
            command: 'addClanWar',
            icon: this.path + 'images/war.png'
        });
    }
});