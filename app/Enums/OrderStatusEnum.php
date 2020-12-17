<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatusEnum extends Enum
{
    const CONFIRM = 'Xác nhận đơn hàng';

    const IS_PREPARING_ORDER = 'Đang chuẩn bị đơn hàng';

    const COMPLETE_ORDER_PACKING = 'Hoàn tất đóng gói đơn hàng';

    const HAS_BEEN_HANDED_OVER_TO_THE_CARRIER = 'Đã bàn giao cho đơn vị vận chuyễn';

    const COMPLETE_ORDER = 'Hoàn tất đơn hàng';

    const REIMBURSEMENT_REQUEST = 'Yêu cầu hoàn trả';

    const ACCEPT_REFUND = 'Chấp nhận yêu cầu hoàn trả';

    const CANCEL_ORDER = 'Đã Hủy đơn';
}
