/**
 * Some random JS effects
 * Copyright John Johnson 2011-2015. This script may not be resold.
 */
"use strict";
var app = window.app || {};

app = {
	version: 1,
	
	getComment: function(){
		var form = jQuery( '#comments' );
		commentList = jQuery( form ).find( 'li' );
		
		return commentlist;
	},
	
	init: function(){
		list = this.getComment();
		jQuery( '.comment-list' ).addClass( 'blue' );
	}
}

app.init();
