import { mount } from '@vue/test-utils';
import Websites from '../../src/components/Websites.vue';

describe('Websites', () => {
  it('should render correctly', () => {
    const wrapper = mount(Websites)
    expect(wrapper.element).toMatchSnapshot()
  });
});
