<div id="canvas">
		<div class="sj-book">
			<div depth="5" class="hard"> <div class="side"></div> 
			<div style="font-size:20px;font-style:Palatino;margin-top:100px;margin-left:140px;">
				{if $post->title != null}
				{$post->title}
				{else}
				Untitled
				{/if}
				<br />
				<span style="font-size:14px;">
					{$post->author_name}
				</span>
			</div>
			
			
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
