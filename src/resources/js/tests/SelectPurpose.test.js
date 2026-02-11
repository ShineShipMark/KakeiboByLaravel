// コンポーネントを疑似的に組み立てる関数
import { mount } from '@vue/test-utils';
// vitestをインポート
import { expect, test, vi } from 'vitest';
// テスト対象のコンポーネントをインポート
import SetSelectPurpose from '@/components/inputParts/setSelectPurpose.vue';
// ストアをインポート
import { useInputDataStore } from '../stores/inputDataStore'
// テスト用に空っぽのPiniaを作成するためのツール
import { createTestingPinia } from '@pinia/testing';

// テスト開始
test('正しくプルダウンされる', async () => {
    // 
    const pinia = createTestingPinia({
        // すべてのアクションを見張っている状態にする
        createSpy: vi.fn, // ストア内の関数が実際に呼ばれたか、どんな引数で呼ばれたかをテストでチェックできるようになる
        // テスト開始時のデータ状態を固定、初期値
        initialState: {
            purpose: { // ストアのID
                pusposeData: [{ id: 1, purpose_id: 1, amount: 100, at_date: new Date(), posession: 'account', detail: 'test' }],
                selectedPurposeId: null
            }
        }
    });

    //
    const wrapper = mount(SetSelectPurpose, {
        global: {
            plugins: [pinia],
            // shadcn/vueの各種ツールをスタブ化(決まったダミーの値を設定)する。shadcnが複雑なため簡易化
            stubs: {
                Select: true,
                SelectTrigger: true,
                SelectValue: true,
                SelectGroup: true,
                SelectItem: true,
                SelectLabel: true,
            }
        }
    });

    // ストアを呼び出し
    const store = useInputDataStore();

    // コンポーネントを指定(この場合、shadcn/vueの<SELECT>を指定する)
    const selectComponent = wrapper.findComponent({ name: 'SELECT' });
    // 『purpose_idで1が選ばれた』という通知を直接発信する
    await selectComponent.vm.$emit('update:modelValue', '1');
    //  ストアの中身が、上述した1になっているか判定する
    expect(store.selectedPurposeId).toBe('1');
});
