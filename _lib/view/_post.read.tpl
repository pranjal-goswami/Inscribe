<div id="canvas">
		<div class="sj-book">
			<div depth="5" class="hard" style="text-align:center;font-weight:900;font-size:20px;"> <div class="side"></div> 
			<br /><br /><br />{$post->title}
			<br />
			By {$post->author_name}
		</div>
			<div depth="5" class="hard front-side"> <div class="depth"></div> </div>
			<div class="own-size"></div>
			{foreach from=$post->pages item=page}
			<div class="own-size"><div class="page-content" style="padding:30px;text-align:justify;">{$page}</div></div>
			{/foreach}
			{if $post->page_count == 0}
			<div class="own-size"></div>
			{/if}
			<div class="hard fixed back-side hard-last-page"> <div class="depth"></div> </div>
		</div>
</div>

{literal}
<script>

loadApp();

</script>
{/literal}
