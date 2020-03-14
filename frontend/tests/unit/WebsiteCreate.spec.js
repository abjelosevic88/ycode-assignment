import { mount } from '@vue/test-utils';
import WebsitesCreate from '../../src/components/WebsitesCreate.vue';

describe('WebsitesCreate', () => {
  it('should render correctly', () => {
    const wrapper = mount(WebsitesCreate)
    expect(wrapper.element).toMatchSnapshot()
  });
});
