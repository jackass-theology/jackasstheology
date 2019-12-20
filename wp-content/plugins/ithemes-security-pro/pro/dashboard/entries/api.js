import { createSlotFill } from '@wordpress/components';

import './dashboard/store';

const { Fill: AdminBarFill, Slot: AdminBarSlot } = createSlotFill( 'AdminBar' );
export { AdminBarFill, AdminBarSlot };
