import { mount } from '@vue/test-utils';
import Layout from '../../src/components/Layout.vue';

describe('Layout', () => {
  it('should render correctly', () => {
    const wrapper = mount(Layout)
    expect(wrapper.element).toMatchSnapshot()
  });
});
