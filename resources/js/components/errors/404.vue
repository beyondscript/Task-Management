<template>
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-body">
	                    <div style="display: flex; justify-content: center; align-items: center;">
	                        <div style="text-align: center;">
	                            <img style="width: 260px;" :src="'/images/404-not-found.webp'">
	                            <h3 style="text-transform: uppercase; margin-bottom: 0;">Page Not Found</h3>
	                            <p style="padding-bottom: 10px; padding-left: 5px; padding-right: 5px; padding-top: 5px; margin-bottom: 0;">The page you are looking for might have been removed or temporarily unavailable.</p>
	                            <a class="link" style="width: 130px !important; text-transform: uppercase;" :href="'/'">Go To Home</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</template>

<style scoped>
	.card{
		border: none;
	}
</style>