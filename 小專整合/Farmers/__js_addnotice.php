<script>
function addnotice(action, action_id, action_time) {
    let content =
        `You just ${action} a item which ID is "${action_id}" at ${action_time}.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
    let dropdown_item = document.createElement("div");
    dropdown_item.className = "dropdown-item alert alert-warning alert-dismissible fade show";
    dropdown_item.setAttribute("role", "alert");
    dropdown_item.setAttribute("style", "margin:5px 0");
    dropdown_item.innerHTML = content;
    document.querySelector('#notice-dropdown').appendChild(dropdown_item);
};
</script>