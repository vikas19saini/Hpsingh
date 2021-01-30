<?php
$this->assign('css', $this->Html->css('admin/daterangepicker') . $this->Html->css('admin/daterangepicker'));
$this->assign('script', $this->Html->script('admin/moment.min') . $this->Html->script('admin/daterangepicker.min'));
?>
<div class="main_user">
    <div class="user_section">
        <h2>All Orders (<?= $this->Paginator->params()['count'] ?>)</h2>
    </div>
    <div class="user_bulk product-controls">
        <div class="media_pagination full-width">
            <span><?= $this->Paginator->params()['count'] ?> Items</span>
            <?= $this->Paginator->first('<button type="button"><i class="fa fa-angle-double-left"></i></button>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<button type="button"><i class="fa fa-angle-left"></i></button>', ['escape' => false]); ?>
            <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" min="1" type="text" max="<?= $this->Paginator->total() ?>" value="<?= $this->Paginator->current() ?>">
            <span>of <?= $this->Paginator->total(); ?></span>
            <?= $this->Paginator->next('<button type="button"><i class="fa fa-angle-right"></i></button>', ['escape' => false]); ?>
            <?= $this->Paginator->last('<button type="button"><i class="fa fa-angle-double-right"></i></button>', ['escape' => false]) ?>
        </div>
        <div class="bulk_user3 product-options full-width">
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)']) ?>
            <?= $this->Form->select('action', ['Change Order Status To' => \Cake\Core\Configure::read('OrderStatus')], ['empty' => 'Bulk Actions']) ?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none']) ?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2']) ?>
            <?= $this->Form->end() ?>
            <form method="get">
                <div id="reportrange" class="date-picker">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <input type="hidden" name="start-date">
                <input type="hidden" name="end-date">
                <div id="select-2_parent">
                    <select name="customer_id"></select>
                </div>
                <button>Filter</button>
            </form>
        </div>

        <!-- <div class="bulk_user3 product-options full-width">
            <?= $this->Form->create('Document', ['url' => ['action' => 'uploadCsv'], 'enctype' => 'multipart/form-data']) ?>
            <?= $this->Form->file('file') ?>
            <?= $this->Form->button('Upload') ?>
            <?= $this->Form->end() ?>
        </div> -->

    </div>

    <div class="user_details product_details">
        <table class="hptable">
            <thead>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>ORDER</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>SHIP TO</th>
                    <th>PAYMENT</th>
                    <th>TOTAL</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($orders->count() > 0) : foreach ($orders as $order) : ?>
                        <tr class="<?= $order->status ?>">
                            <td class="check">
                                <input type="checkbox" name="itemId[]" value="<?= $order->id ?>">
                            </td>
                            <td>
                                <a href="<?= $this->Url->build(['action' => 'view', $order->id]) ?>">
                                    #<?= $order->id ?>,&nbsp;<?= $order->name ?>,&nbsp;<?= $order->email ?>
                                </a>
                            </td>
                            <td><?= date_format($order->created, 'D d M, Y h:m A') ?></td>
                            <td><span><?= ucwords(str_replace('-', ' ', $order->status)) ?></span></td>
                            <td>
                                <b><?= $order->sname ?></b><br />
                                <?= $order->shipping_address, ', ', $order->sphone ?>
                            </td>

                            <td><?= $order->payment_mode ?></td>
                            <td><?= $this->Number->currency($order->grand_total / $order->currency_value, 'INR') ?></td>
                            <td>
                                <a href="<?= $this->Url->build(['action' => 'completeOrder', $order->id]) ?>" class="order_action" title="Complete">
                                    <i class="dashicons dashicons-yes"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;
                else : ?>
                    <tr>
                        <td colspan="8">
                            <h2 align="center">No order found!</h2>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>ORDER</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>SHIP TO</th>
                    <th>PAYMENT</th>
                    <th>TOTAL</th>
                    <th>ACTIONS</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?= $this->Html->scriptStart(['block' => true]) ?>

$(function() {

var start = '';
var end = '';

function cb(start, end) {
$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
$('input[name=start-date]').val(start.format('YYYY-MM-D'));
$('input[name=end-date]').val(end.format('YYYY-MM-D'));
}

$('#reportrange').daterangepicker({
startDate: moment().subtract(29, 'days'),
endDate: moment(),
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
},

autoApply: true,
}, cb);

cb(start, end);

});
<?= $this->Html->scriptEnd() ?>

<script>
    window.onload = () => {
        $("select[name=customer_id]").select2({
            placeholder: 'Filter order by customer',
            dropdownParent: $('#select-2_parent'),
            allowClear: true,
            ajax: {
                url: function(params) {
                    return '<?= $this->Url->build(['controller' => 'Users', 'action' => 'searchForUsers', 'prefix' => 'hpadmin', 'plugin' => false]) ?>/' + params.term;
                },
                dataType: 'json',
                delay: 250,
                minimumInputLength: 3,
                data: function(params) {
                    return;
                },
                processResults: function(data, params) {
                    var data = $.map(data, function(obj) {
                        var item = {
                            id: obj.id,
                            text: `${obj.name} (ID:${obj.id}-${obj.email})`
                        };

                        return item;
                    });

                    return {
                        results: data,
                    }
                },
            },

        });
    };
</script>