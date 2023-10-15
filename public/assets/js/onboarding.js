

	$('#onboardingform').bootstrapValidator({
		fields: {
			photo: {
				validators: {
					notEmpty: {
						message: 'photo is required'
					}
				}
			},
			name: {
				validators: {
					notEmpty: {
						message: 'The name is required and can\'t be empty'
					},
					stringLength: {
                        max: 250,
                        message: 'It must be less than 50 characters'
                    }
				}
			},
			description: {
				validators: {
					notEmpty: {
						message: 'The description is required and can\'t be empty'
					},
					stringLength: {
                        max: 255,
                        message: 'It must be less than 255 characters'
                    }
				}
			},
		}
	});
	$('#onboardingupdateform').bootstrapValidator({
		fields: {
			name: {
				validators: {
					notEmpty: {
						message: 'The name is required and can\'t be empty'
					},
					stringLength: {
                        max: 250,
                        message: 'It must be less than 50 characters'
                    }
				}
			},
			description: {
				validators: {
					notEmpty: {
						message: 'The description is required and can\'t be empty'
					},
					stringLength: {
                        max: 255,
                        message: 'It must be less than 255 characters'
                    }
				}
			},
		}
	});


